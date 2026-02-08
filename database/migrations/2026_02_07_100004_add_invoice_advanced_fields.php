<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('invoices', function (Blueprint $table): void {
            $table->decimal('paid_amount', 18, 2)->default(0)->after('total');
            $table->decimal('due_amount', 18, 2)->default(0)->after('paid_amount');
            $table->string('invoice_prefix')->nullable()->after('invoice_number');
        });
    }

    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table): void {
            $table->dropColumn(['paid_amount', 'due_amount', 'invoice_prefix']);
        });
    }
};
