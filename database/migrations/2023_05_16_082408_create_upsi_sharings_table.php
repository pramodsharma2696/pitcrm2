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
        Schema::create('upsi_sharings', function (Blueprint $table) {
            $table->id();
            $table->string('upsi_id');
            $table->enum('status', [1, 0])->default(0);
            $table->string('sender_name');
            $table->string('recipient_name');
            $table->unsignedBigInteger('sender_id');
            $table->unsignedBigInteger('recipient_id');
            $table->string('purpose_of_sharing');
            $table->date('sharing_date');
            $table->string('event_name')->nullable();
            $table->date('event_date');
            $table->date('publishing_date')->nullable();
            $table->enum('trading_window', ['open', 'closed']);
            $table->date('closure_start_date')->nullable();
            $table->date('closure_end_date')->nullable();
            $table->date('approved_date')->nullable();
            $table->text('remarks')->nullable();
            $table->boolean('notice_of_confidentiality_shared')->default(false);
            $table->string('file_name')->nullable();
            $table->string('file_path')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('published_at')->nullable();
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
        Schema::dropIfExists('upsi_sharings');
    }
};
