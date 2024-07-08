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
        Schema::create('insiders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('connected_person_id')->nullable();
            $table->enum('category_type', ['connected_person', 'designated_person']);
            $table->enum('type', ['individual', 'entity'])->nullable();
            $table->string('name')->nullable();
            $table->string('father_or_husband_name')->nullable();
            $table->string('pan')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('correspondence_address')->nullable();
            $table->string('nature_of_connection')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->unsignedBigInteger('demat_account_number')->nullable();
            $table->string('designation')->nullable();
            $table->string('no_of_share_held')->nullable();


            // entity
            $table->string('no_of_entity')->nullable();
            $table->text('entity_permanent_address')->nullable();
            $table->text('entity_correspondence_address')->nullable();
            $table->string('entity_pan')->nullable();
            $table->text('entity_declaration')->nullable();
            $table->string('entity_registration_number')->nullable();
            $table->string('authorized_personnel_name')->nullable();
            $table->string('authorized_personnel_email')->nullable();
            $table->string('authorized_personnel_mobile_number')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('connected_person_id')->references('id')->on('connected_people')->onDelete('cascade');

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
        Schema::dropIfExists('insiders');
    }
};
