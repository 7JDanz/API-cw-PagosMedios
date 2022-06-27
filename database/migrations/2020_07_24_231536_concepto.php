<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Concepto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('concepto', function (Blueprint $table) {
            //$uuid = DB::raw('select UUID()');
            $table->increments('id');

            $table->string('descripcion');
            $table->float('valor');
            $table->unsignedInteger('grado_id')->nullable();
            $table->timestamps();
            $table->string('grupo_grado_id');
            $table->foreign('grado_id')->references('id')->on('grado');
            //$table->primary('id_concepto');
            //$table->primary(['id', 'grado_id']);
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
