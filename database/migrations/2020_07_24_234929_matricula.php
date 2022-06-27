<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Matricula extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matricula', function (Blueprint $table) {

        //$uuid = DB::raw('select UUID()');
        $table->uuid('id');
        $table->string('matricula')->nullable();
        $table->timestamp('fecha_inicio')->nullable();
        $table->timestamp('fecha_fin')->nullable();
        $table->boolean('status')->default(true);
        $table->unsignedInteger('grado_id');
        $table->uuid('persona_id');
        $table->timestamps();
        //$table->primary('id_matricula');
        $table->foreign('persona_id')->references('id')->on('persona');
        $table->foreign('grado_id')->references('id')->on('grado');
        $table->primary(['id', 'persona_id','grado_id']);
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
