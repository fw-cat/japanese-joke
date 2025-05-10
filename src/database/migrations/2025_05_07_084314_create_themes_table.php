<?php

use App\Enums\ThemeStatus;
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
        Schema::create('themes', function (Blueprint $table) {
            $table->id();

            $table->text('content')->nullable(false)->comment('テーマ');
            $table->integer("status", unsigned: true)->default(ThemeStatus::ACTIVE->value)->comment('ステータス');

            $table->timestamps();
            $table->softDeletes();
            $table->comment('だじゃれのお題');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('themes');
    }
};
