<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table): void {
            $table->id();
            $table->json('title');
            $table->json('short_description')->nullable();
            $table->json('description')->nullable();
            $table->string('icon')->nullable();
            $table->unsignedInteger('order')->default(0);
            $table->string('status')->default('draft');
            $table->json('seo_meta')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
