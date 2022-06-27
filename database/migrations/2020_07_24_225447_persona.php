<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Persona extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('persona', function (Blueprint $table) {
            
            //$table->uuid('id_persona');
            //$uuid = DB::raw('select UUID()');
            $table->uuid('id');
            $table->string('identificacion');
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('direccion');
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();
            $table->uuid('representante_persona_id')->nullable();
            $table->timestamps();
            $table->boolean('status')->default(true);            
            $table->unsignedInteger('tipo_documento_id');            

            
            $table->foreign('tipo_documento_id')->references('id')->on('tipo_documento');
            //$table->foreign('representante_persona_id')->references('id_persona')->on('persona');

            //$table->primary('id_persona'); 
            $table->primary(['id','tipo_documento_id']);
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
