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
        Schema::create('cancelled_appointments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('justification')->nullable();

            $table->unsignedBigInteger('cancelled_by');
            $table->foreign('cancelled_by')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('citas_medicas_id');
            $table->foreign('citas_medicas_id')->references('id')->on('citas_medicas')->onDelete('cascade');

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
        Schema::dropIfExists('cancelled_appointments');
    }
};
