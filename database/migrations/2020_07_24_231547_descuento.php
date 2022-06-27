<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Descuento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('descuento', function (Blueprint $table) {
            //$uuid = DB::raw('select UUID()');
            $table->increments('id');
            //$table->uuid('id_descuento');
            $table->string('descripcion');
            $table->smallInteger('min');
            $table->smallInteger('max');
            $table->float('valor');
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->string('grupo_grado_id');
            $table->unsignedInteger('grado_id')->nullable();
            //$table->primary('id_descuento');
            $table->foreign('grado_id')->references('id')->on('grado');
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
