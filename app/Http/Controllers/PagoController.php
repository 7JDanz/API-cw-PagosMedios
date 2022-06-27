<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\StatusController;
use App\Pago;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function crearPago($data,$request)
    {
        $pago=$this->buscarPago($data,$request);
        if(empty($pago)){

            $status = new StatusController();
            $status_id = $status->estado('Pago','Activo');
            $concepto_descuento = isset($data['descuento'][0])?$data['descuento'][0]->id:NULL;
            $current_date = Carbon::parse($request->ShootDateTime)->timezone('America/Guayaquil')->format('Y/m/d');

            $matricula = Pago::create([
                'matricula_id'              => $data['datos'][0]->matricula_id
                ,'mes_id'                   => $request->get('mes')
                ,'concepto_descuento_id'    => $concepto_descuento
                ,'concepto_id'              => $data['concepto'][0]->id
                ,'fecha'                    => "$current_date"
                ,'status_id'                => $status_id[0]->id
            ]);

            return $pago=$this->buscarPago($data,$request);
        }else{
            return $pago;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function buscarPago($data,$request)
    {
        $status = new StatusController();
        $status_id = $status->estado('Pago','Activo');

        $id = DB::table('pago')->where([
                ["matricula_id",'=',$data['datos'][0]->matricula_id]
                ,["concepto_id",'=',$data['concepto'][0]->id]
                ,["mes_id","=",$request->get('mes')]
                ,["status_id",'=',$status_id[0]->id]
           ])->get()->toArray();
       return $id;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function edit(Pago $pago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pago $pago)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pago $pago)
    {
        //
    }
}
