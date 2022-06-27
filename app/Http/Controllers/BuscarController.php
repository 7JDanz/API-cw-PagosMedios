<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\ConceptoController;
use App\Http\Controllers\Admin\DescuentoController;
use App\Http\Controllers\Admin\MatriculaController;
use App\Http\Controllers\Admin\PersonaController;
use App\Models\Persona;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BuscarController extends Controller
{
    //
    var $select = [
                    'estudiante.id                  as estudiante_id'
                    ,'estudiante.nombres            as estudiante_nombres'
                    ,'estudiante.apellidos          as estudiante_apellidos'
                    ,'representante.identificacion  as representante_identificacion'
                    ,'representante.nombres         as representante_nombres'
                    ,'representante.apellidos       as representante_apellidos'
                    ,'representante.direccion       as representante_direccion'
                    ,'representante.telefono        as representante_telefono'
                    ,'representante.email           as representante_email'
                    ,'representante.tipo_documento_id  as representante_tipo_documento_id'
                    ,'matricula.id                  as matricula_id'
                    ,'matricula.grado_id            as matricula_grado_id'
    ];

    public function busqueda(Request $request)
    {

        $data='';
        $param = $request->get('identificacion');
        if(is_numeric($param)){

            $buscar = DB::table('persona as estudiante')
                        ->select(
                            $this->select
                                )
                        ->join('persona as representante','estudiante.identificacion','=','representante.representante_persona_id')
                        ->join('matricula','matricula.persona_id','=','estudiante.id')
                        ->where(function($query) use($param){
                            $query->where('estudiante.identificacion',$param)
                                ->orWhere('matricula.matricula',$param);
                        })
                        ->get()->toArray();

            if(empty($buscar)){
                //consulta SGA

                $data      = $this->busquedaSGA($request);
                if(isset($data[0]->error)) return response()->json($data);
                //parsear DATA
                $data      = $this->getParseWSDL($data);
                //crea Usuario y Matricula
                $buscar    = $this->crearUsuario($data,$param);
            }

            /**
             * FORMATEAR EN UN SOLO TIPO DE DATPS
             */
            $buscar = json_encode($buscar);
            $buscar = json_decode($buscar);

            if(!empty($buscar)){

                $concepto   = $this->buscarConcepto($buscar,$request);
                $descuento  = $this->buscarDescuento($buscar,$request);

                $buscar     = array( 'datos'=>$buscar
                                ,'concepto'=>$concepto
                                ,'descuento'=>$descuento);

                $pago       = $this->crearPago($buscar,$request);
                //$buscar = array_push($buscar,$pago);
                $buscar     = array($buscar,'pago'=>$pago);

            }
        }else{
            return response()->json(["Error"=>"Ingrese solo números"]);
        }
            return response()->json($buscar);

    }

    public function buscarConcepto($data,$request){
        $concepto = new ConceptoController();
        return $result=$concepto->buscarConcepto($data,$request);
    }

    public function buscarDescuento($data,$request){
        $descuento = new DescuentoController();

        return $result=$descuento->buscarDescuento($data,$request);
    }

    public function crearPago($data,$request){
        $pago = new PagoController();
        return $result=$pago->crearPago($data,$request);
    }

    public function crearUsuario($data,$param){

        DB::beginTransaction();
        try {

            $persona    = new PersonaController();
            $matricula  = new MatriculaController();

            $persona_id         = $persona->save($data['personas']['estudiante']);
            $representante_id   = $persona->save($data['personas']['representante']);

            $fecha_inicio = Carbon::now();

            $data_matricula     = array(
                    "matricula" => array(
                        'fecha_fin'         =>$fecha_inicio,
                        'fecha_inicio'      =>$fecha_inicio,
                        'grado_id'          =>$data['grado']['id'],
                        'persona_id'        =>$persona_id,
                        'status'            =>1,
                        'matricula'         =>$param
                ));

            $matricular = $matricula->save($data_matricula['matricula']);


            $select = [Array(
                    'estudiante_id'                 =>$persona_id
                    ,'estudiante_nombres'           =>$data['personas']['estudiante']['nombres']
                    ,'estudiante_apellidos'         =>$data['personas']['estudiante']['apellidos']
                    ,'representante_identificacion' =>$data['personas']['representante']['identificacion']
                    ,'representante_nombres'        =>$data['personas']['representante']['nombres']
                    ,'representante_apellidos'      =>$data['personas']['representante']['apellidos']
                    ,'representante_direccion'      =>$data['personas']['representante']['direccion']
                    ,'representante_telefono'       =>$data['personas']['representante']['telefono']
                    ,'representante_email'          =>$data['personas']['representante']['email']
                    ,'representante_tipo_documento_id'  =>$data['personas']['representante']['tipo_documento_id']
                    ,'matricula_id'                 =>$matricular[0]->id
                    ,'matricula_grado_id'           =>$matricular[0]->grado_id
            )];

            DB::commit();
            return $select;

        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }




    public function busquedaSGA(Request $request)
    {

        $username 	= 'sga_uecw';
        $password 	= 'TArp@JKfrDg';
        $prefijo 	= 'uecw';
        $id_usuario = $request->get('identificacion'); 	//	REQUERIDO
        $periodo 	= '';		                //	REQUERIDO
        $id_curso	= 0;

        $wsdl = env('SGA_WSDL');

        try{
            $cliente = new \SoapClient($wsdl);
            $record_in = array(
                "entrada_usuarios" => array(
                    'id_usuario'    => '',
                    'id_curso'      => $id_curso,
                    'periodo'       => $periodo,
                    'username'      => $username,
                    'password'      => $password,
                    'prefijo'       => $prefijo,
                    'matricula'     => $id_usuario)
                );

            $response = $cliente->__soapCall("lista_usuarios",$record_in);
            return $response;

        } catch (\Throwable $e){

            return $response=array("error"=>"Existe problemas de conectevidad contactese con el administrador");
            Log::error($e);
        }
    }

    public function getParseWSDL($response){
        try{
            $estudiante = (array(
                'apellidos'                 => $response[0]->apellido,
                'direccion'                 => $response[0]->direccion,
                'email'                     => $response[0]->email,
                'identificacion'            => $response[0]->cedula,
                'nombres'                   => $response[0]->nombre,
                'representante_persona_id'  => NULL,
                'status'                    => 1,
                'telefono'                  => $response[0]->telefono,
                'tipo_documento_id'         => 1
            ));

            $representante =(array(
                'apellidos'                 => $response[0]->rep_legal_apellido,
                'direccion'                 => $response[0]->rep_legal_direccion,
                'email'                     => $response[0]->rep_legal_email,
                'identificacion'            => $response[0]->rep_legal_cedula,
                'nombres'                   => $response[0]->rep_legal_nombre,
                'representante_persona_id'  => $response[0]->cedula,
                'status'                    => 1,
                'telefono'                  => $response[0]->rep_legal_telefono,
                'tipo_documento_id'         => 1
            ));

            $grado = (array(
                'id'                        => $response[0]->id_curso,
                'descripcion'               => $response[0]->curso
            ));

            $array_personas = array(
                'personas'=> array(
                    'estudiante'                => $estudiante,
                    'representante'             => $representante),
                'grado' => $grado
            );
            return  $array_personas;
        } catch (\Throwable $e){
            Log::error($e);
            return $response[0]->error?array("error"=>$response[0]->error):array("error"=>"No existe el usuario ");
        }
    }
}
