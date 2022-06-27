<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Status extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('status', function (Blueprint $table) {

            //$uuid = DB::raw('select UUID()');
            $table->increments('id');
            $table->string('descripcion')->nullable();
            $table->unsignedInteger('modulo_id');
            $table->foreign('modulo_id')->references('id')->on('modulo');

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
