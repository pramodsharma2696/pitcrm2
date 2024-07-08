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
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->string('upsi_id');
            $table->enum('status', [1, 0])->default(0);
            $table->string('sender_name');
            $table->string('recipient_name');
            $table->string('sender_id');
            $table->string('recipient_id');
            $table->string('purpose_of_sharing');
            $table->string('sharing_date');
            $table->string('event_name')->nullable();
            $table->string('event_date');
            $table->string('publishing_date');
            $table->enum('trading_window', ['open', 'closed']);
            $table->string('closure_start_date')->nullable();
            $table->string('closure_end_date')->nullable();
            $table->text('remarks')->nullable();
            $table->enum('notice_of_confidentiality_shared', ['1', '0']);
            $table->string('name')->nullable();
            $table->string('file_path');
            $table->string('created_by');
            $table->string('updated_by')->nullable();
            $table->string('published_at')->nullable();
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
        Schema::dropIfExists('tests');
    }
};
