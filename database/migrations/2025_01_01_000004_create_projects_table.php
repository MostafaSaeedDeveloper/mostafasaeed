<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table): void {
            $table->id();
            $table->json('title');
            $table->string('slug')->unique();
            $table->json('summary')->nullable();
            $table->json('case_study')->nullable();
            $table->json('tech_stack')->nullable();
            $table->string('category')->nullable();
            $table->string('main_image_path')->nullable();
            $table->string('live_url')->nullable();
            $table->string('repo_url')->nullable();
            $table->json('metrics')->nullable();
            $table->boolean('featured')->default(false);
            $table->string('status')->default('draft');
            $table->json('seo_meta')->nullable();
            $table->foreignId('customer_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
