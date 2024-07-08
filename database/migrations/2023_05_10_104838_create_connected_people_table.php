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
        Schema::create('connected_people', function (Blueprint $table) {
            $table->id();
            $table->string('connected_person_id')->nullable();
            $table->string('iuid');
            $table->string('immediate_relative_id')->nullable();
            $table->string('financial_relative_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->enum('type', ['individual', 'entity'])->nullable();
            $table->enum('category_type', [
                 'connected person',
                 'designated person',
                 'immediate relative',
                 'financial relative',
                 ])->default('connected person');
            $table->enum('is_insider', ['0', '1'])->default('0');
            $table->string('name')->nullable();
            $table->string('pan')->nullable();
            $table->enum('pan_option', ['Yes', 'No'])->nullable();
            $table->string('pan_attachment')->nullable();
            $table->string('declaration_attachment')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('correspondence_address')->nullable();
            $table->enum('nature_of_connection', [
                'Executive Director',
                'Non Executive Director',
                'Key Managerial Personnel',
                'Designated Employee',
                'Holding Company',
                'Subsidiary Company',
                'Associate Company',
                'Group Company',
                'Director of Group/Holding/Subsidiary/Associate Company',
                'Designated Employee of Group/Holding/Subsidiary/Associate Company',
                'Intermediary/Director of Intermediary/Employee of Intermediary',
                'Investment Co./Trustee Co./AMC/ Its Directors or Employees',
                'Official of Stock Exchange',
                'Member of Board of Trustees/AMC of MF or its Employees',
                'Member of BOD/ Employee of PFI',
                'Official of SRO',
                'Banker',
                'Body Corporate/AOP/Concern wherein Director/Banker has more than 10% Interest',
            ])->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->unsignedBigInteger('demat_account_number')->nullable();
            $table->string('designation')->nullable();
            $table->string('no_of_share_held')->nullable();


            // entity
            $table->string('no_of_entity')->nullable();
            $table->text('entity_permanent_address')->nullable();
            $table->text('entity_correspondence_address')->nullable();
            $table->text('type_of_entity')->nullable();
            $table->text('entity_declaration')->nullable();
            $table->string('entity_registration_number')->nullable();
            $table->string('authorized_personnel_name')->nullable();
            $table->string('authorized_personnel_email')->nullable();
            $table->string('authorized_personnel_mobile_number')->nullable();
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
        Schema::dropIfExists('connected_people');
    }
};
