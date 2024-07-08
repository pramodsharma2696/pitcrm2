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
        Schema::table('relatives', function (Blueprint $table) {
            $table->string('iuid')->nullable()->after('user_id');
            $table->string('pan_attachment')->nullable()->after('pan');

        });
        
        Schema::table('financial_relatives', function (Blueprint $table) {
            $table->string('iuid')->nullable()->after('user_id');
            $table->string('pan_attachment')->nullable()->after('pan');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('relatives', function (Blueprint $table) {
            $table->dropColumn('iuid');
            $table->string('pan_attachment');

        });
        
        Schema::table('financial_relatives', function (Blueprint $table) {
            $table->dropColumn('iuid');
            $table->string('pan_attachment');

        });
    }
};
