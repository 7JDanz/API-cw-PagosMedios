<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Integracion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('integracion', function (Blueprint $table) {
            //$uuid = DB::raw('select UUID()');
            $table->uuid('id');
            //$table->uuid('id_integracion');
            $table->json('DATA_Generate_Payment')->nullable();
            $table->json('DATA_Response')->nullable();
            $table->timestamp('fecha_expiracion');
            $table->uuid('pago_id');
            $table->unsignedInteger('status_id');
            $table->timestamps();

            //$table->primary('id_integracion');

            $table->foreign('pago_id')->references('id')->on('pago')->onDelete('cascade');
            //$table->primary(['id', 'pago_id']);
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
