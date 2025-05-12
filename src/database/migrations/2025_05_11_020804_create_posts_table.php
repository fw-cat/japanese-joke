<?php

use App\Enums\PostStatus;
use App\Models\Post;
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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('theme_id')->constrained('themes');   
            $table->string('content')->nullable(false)->comment('投稿内容');
            $table->string('user_name', 1024)->nullable(true)->default(Post::DEFAULT_USER_NAME)->comment('投稿者');
            $table->integer('status')->default(PostStatus::REGISTERED)->comment('ステータス');
            $table->timestamps();
            $table->softDeletes();
            $table->comment("投稿");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
