<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attend_appointments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('diagnostic');

            //Clave foranea Citas medicas
            $table->unsignedBigInteger('citas_medicas_id');
            $table->foreign('citas_medicas_id')->references('id')->on('citas_medicas')->onDelete('cascade');
            
            
            //Clave foranea enfermedades
            $table->unsignedBigInteger('enfermedades_id');
            $table->foreign('enfermedades_id')->references('id')->on('users')->onDelete('cascade');

            //Clave foranea de medicamentos
            $table->unsignedBigInteger('medicamentos_id');
            $table->foreign('medicamentos_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('indications');
            $table->date('nextAppointment');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attend_appointments');
    }
};
