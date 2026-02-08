<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table): void {
            $table->string('brand_name')->nullable()->after('site_name');
            $table->string('favicon_path')->nullable()->after('logo_path');
            $table->string('tax_number')->nullable()->after('contact_phone');
            $table->string('currency_format')->default('symbol')->after('base_currency_id');
            $table->string('timezone')->default('Africa/Cairo')->after('currency_format');
            $table->string('date_format')->default('Y-m-d')->after('timezone');
            $table->string('invoice_prefix')->default('INV-')->after('date_format');
            $table->unsignedBigInteger('invoice_start_number')->default(1)->after('invoice_prefix');
            $table->unsignedTinyInteger('default_due_days')->default(7)->after('invoice_start_number');
            $table->text('invoice_terms')->nullable()->after('default_due_days');
            $table->text('invoice_notes')->nullable()->after('invoice_terms');
            $table->string('invoice_template')->default('classic')->after('invoice_notes');
            $table->boolean('tax_enabled')->default(false)->after('invoice_template');
            $table->decimal('default_tax_rate', 5, 2)->default(0)->after('tax_enabled');
            $table->boolean('tax_inclusive')->default(false)->after('default_tax_rate');
            $table->boolean('allow_item_discount')->default(true)->after('tax_inclusive');
            $table->boolean('allow_invoice_discount')->default(true)->after('allow_item_discount');
            $table->longText('invoice_email_template')->nullable()->after('allow_invoice_discount');
            $table->boolean('overdue_notifications_enabled')->default(false)->after('invoice_email_template');
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table): void {
            $table->dropColumn([
                'brand_name',
                'favicon_path',
                'tax_number',
                'currency_format',
                'timezone',
                'date_format',
                'invoice_prefix',
                'invoice_start_number',
                'default_due_days',
                'invoice_terms',
                'invoice_notes',
                'invoice_template',
                'tax_enabled',
                'default_tax_rate',
                'tax_inclusive',
                'allow_item_discount',
                'allow_invoice_discount',
                'invoice_email_template',
                'overdue_notifications_enabled',
            ]);
        });
    }
};
