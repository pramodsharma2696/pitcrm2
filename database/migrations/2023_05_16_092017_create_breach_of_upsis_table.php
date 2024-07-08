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
        Schema::create('breach_of_upsis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('upsi_id');
            $table->unsignedBigInteger('insider_id')->nullable();
            $table->string('insider_name');
            $table->enum('status', ['Pending', 'In Process','Completed']);
            $table->string('effect_of_breach');
            $table->string('gain_or_loss');
            $table->string('action_taken');
            $table->string('breach_type');
            $table->text('breach_details');
            $table->date('date_of_commiting_breach');
            $table->date('reporting_date');
            $table->string('names')->nullable();
            $table->timestamps();
            $table->softDeletes();

            
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
        Schema::dropIfExists('breach_of_upsis');
    }
};
