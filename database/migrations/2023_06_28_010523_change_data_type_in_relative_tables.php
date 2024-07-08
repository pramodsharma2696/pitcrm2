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
        Schema::table('connected_people', function (Blueprint $table) {
            $table->string('demat_account_number')->nullable()->change();
        });
    
        Schema::table('relatives', function (Blueprint $table) {
            $table->string('demat_account_number')->nullable()->change();
            $table->string('shares_held')->nullable()->change();

        });
    
        Schema::table('financial_relatives', function (Blueprint $table) {
            $table->string('demat_account_number')->nullable()->change();
            $table->string('shares_held')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('connected_people', function (Blueprint $table) {
            $table->string('demat_account_number')->nullable()->change();
        });
    
        Schema::table('relatives', function (Blueprint $table) {
            $table->string('demat_account_number')->nullable()->change();
            $table->string('shares_held')->nullable()->change();

        });
    
        Schema::table('financial_relatives', function (Blueprint $table) {
            $table->string('demat_account_number')->nullable()->change();
            $table->string('shares_held')->nullable()->change();
        });
    }
};
