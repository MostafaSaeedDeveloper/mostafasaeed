<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('revenues', function (Blueprint $table): void {
            $table->id();
            $table->date('date');
            $table->foreignId('income_category_id')->nullable()->constrained('income_categories')->nullOnDelete();
            $table->string('source')->nullable();
            $table->decimal('amount', 18, 2);
            $table->foreignId('currency_id')->nullable()->constrained('currencies')->nullOnDelete();
            $table->decimal('exchange_rate_to_base', 18, 6)->default(1);
            $table->foreignId('account_id')->nullable()->constrained('accounts')->nullOnDelete();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('revenues');
    }
};
