<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pago extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('pago', function (Blueprint $table) {
            //$uuid = DB::raw('select UUID()');
            $table->uuid('id');
            //$table->uuid('id_pago');
            $table->unsignedInteger('descuento_id')->nullable();
            $table->unsignedInteger('concepto_id');
            $table->date('fecha');
            $table->unsignedInteger('status_id');
            $table->timestamps();
            $table->uuid('matricula_id');
            $table->unsignedInteger('mes_id');

            //$table->primary('id_pago');

            $table->foreign('matricula_id')->references('id')->on('matricula');
            $table->foreign('mes_id')->references('id')->on('mes');
            $table->primary(['id', 'matricula_id','mes_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
