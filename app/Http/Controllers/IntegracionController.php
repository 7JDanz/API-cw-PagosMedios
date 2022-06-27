<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\StatusController;
use App\Integracion;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class IntegracionController extends Controller
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

    public function crearItegracion($data){
        $pago=$this->buscarIntegracion($data);
        if(empty($pago)){

            $status = new StatusController();
            $status_id = $status->estado('Pago','Activo');
            $concepto_descuento = isset($data['descuento'][0])?$data['descuento'][0]->id:NULL;
            $current_date = $data['pago'][0]->fecha;

            $matricula = Integracion::create([
                'DATA_Generate_Payment'     => $data['datos'][0]->matricula_id
                ,'DATA_Response'            => NULL
                ,'fecha_expiracion'         => $concepto_descuento
                ,'pago_id'                  => $data['concepto'][0]->id
                ,'status_id'                => "$current_date"
            ]);

            return $pago=$this->buscarIntegracion($data);
        }else{
            return $pago;
        }


    }

    public function buscarIntegracion($data){
        $status = new StatusController();
        $status_id = $status->estado('Integracion','Activo');

        $id = DB::table('integracion')->where([
                ["pago_id",             '=',$data['datos'][0]->matricula_id]
                ,["status_id",          '=',$status_id[0]->id]
                ,["fecha_expiracion",   '>=',$data['fecha_expiracion']->fecha]
           ])->get()->toArray();
       return $id;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Integracion  $integracion
     * @return \Illuminate\Http\Response
     */
    public function show(Integracion $integracion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Integracion  $integracion
     * @return \Illuminate\Http\Response
     */
    public function edit(Integracion $integracion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Integracion  $integracion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Integracion $integracion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Integracion  $integracion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Integracion $integracion)
    {
        //
    }
}
