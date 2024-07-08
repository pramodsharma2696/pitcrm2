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
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->enum('role', ['admin','user'])->default('user');
            $table->enum('authorized', [0,1])->default(0);
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone');
            $table->string('designation');
            $table->string('password');
            $table->integer('otp')->nullable(); // OTP column
            $table->enum('otp_verified', ['true','false'])->default('false');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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
