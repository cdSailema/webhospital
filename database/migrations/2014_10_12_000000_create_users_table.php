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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->string('cedula')->nullable();
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('email')->unique();
           
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
           
            $table->string('phone')->nullable();
            $table->string('address')->nullable();   
            $table->string('city')->nullable();
            $table->date('birthday')->nullable();
            $table->string('gender')->nullable();
            $table->string('role');

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
