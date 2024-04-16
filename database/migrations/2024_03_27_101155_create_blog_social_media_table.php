<?php

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
        Schema::create('blog_social_media', function (Blueprint $table) {
            $table->id();
            $table->string('blg_facebook')->nullable();
            $table->string('blg_instergram')->nullable();
            $table->string('blg_youtube')->nullable();
            $table->string('blg_linkedin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_social_media');
    }
};
