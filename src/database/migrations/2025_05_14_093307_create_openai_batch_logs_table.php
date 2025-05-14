<?php

use App\Enums\OpenAI\BatchStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('openai_batch_logs', function (Blueprint $table) {
            $table->id();

            $table->string('batche_id', 2048)->nullable(false)->comment('OpenAI Batch ID');
            $table->integer('status')->nullable(false)->default(BatchStatus::REGISTERD->value)->comment('OpenAI Batch Status');

            $table->text("upload_result")->nullable(true)->comment('アップロード時の戻り値JSON');
            $table->text("checked_result")->nullable(true)->comment('チェック時の戻り値JSON');
            $table->text("download_result")->nullable(true)->comment('ダウンロード時の戻り値JSON');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('openai_batch_logs');
    }
};
