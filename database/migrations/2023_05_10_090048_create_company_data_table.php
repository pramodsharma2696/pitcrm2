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
        Schema::create('company_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();
            $table->string('company_name');
            $table->string('registered_office');
            $table->string('corporate_office');
            $table->string('mobile');
            $table->string('email');
            $table->string('cin');
            $table->string('isin');
            $table->string('bse_scrip_code');
            $table->string('nse_scrip_code');
            $table->string('compliance_officer_name');
            $table->string('compliance_officer_mail');
            $table->string('compliance_officer_designation');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('company_data');
    }
};
