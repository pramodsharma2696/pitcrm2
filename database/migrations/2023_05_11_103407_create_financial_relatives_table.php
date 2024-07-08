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
        Schema::create('financial_relatives', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('connected_person_id');
            $table->unsignedBigInteger('user_id');
            $table->enum('is_insider', ['0', '1'])->default('0');
            $table->string('nature_of_relation');
            $table->string('financial_relative_name');
            $table->string('pan');
            $table->string('mobile');
            $table->string('address');
            $table->unsignedBigInteger('shares_held')->nullable();
            $table->unsignedBigInteger('demat_account_number')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('connected_person_id')->references('id')->on('connected_people')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('financial_relatives');
    }
};
