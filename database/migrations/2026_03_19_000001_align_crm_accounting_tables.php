<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('clients', function (Blueprint $table): void {
            if (! Schema::hasColumn('clients', 'email')) {
                $table->string('email')->nullable()->after('name');
            }
            if (! Schema::hasColumn('clients', 'phone')) {
                $table->string('phone')->nullable()->after('email');
            }
            if (! Schema::hasColumn('clients', 'company')) {
                $table->string('company')->nullable()->after('phone');
            }
            if (! Schema::hasColumn('clients', 'country')) {
                $table->string('country')->nullable()->after('company');
            }
            if (! Schema::hasColumn('clients', 'address')) {
                $table->text('address')->nullable()->after('country');
            }
            if (! Schema::hasColumn('clients', 'notes')) {
                $table->text('notes')->nullable()->after('address');
            }
            if (! Schema::hasColumn('clients', 'deleted_at')) {
                $table->softDeletes();
            }
        });

        Schema::table('projects', function (Blueprint $table): void {
            if (! Schema::hasColumn('projects', 'client_id')) {
                $table->foreignId('client_id')->nullable()->after('id')->constrained('clients')->nullOnDelete();
            }
            if (! Schema::hasColumn('projects', 'description')) {
                $table->text('description')->nullable()->after('title');
            }
            if (! Schema::hasColumn('projects', 'start_date')) {
                $table->date('start_date')->nullable()->after('status');
            }
            if (! Schema::hasColumn('projects', 'end_date')) {
                $table->date('end_date')->nullable()->after('start_date');
            }
            if (! Schema::hasColumn('projects', 'budget')) {
                $table->decimal('budget', 10, 2)->default(0)->after('end_date');
            }
            if (! Schema::hasColumn('projects', 'notes')) {
                $table->text('notes')->nullable()->after('budget');
            }
            if (! Schema::hasColumn('projects', 'deleted_at')) {
                $table->softDeletes();
            }
        });

        Schema::table('invoices', function (Blueprint $table): void {
            if (! Schema::hasColumn('invoices', 'client_id')) {
                $table->foreignId('client_id')->nullable()->after('invoice_number')->constrained('clients')->nullOnDelete();
            }
            if (! Schema::hasColumn('invoices', 'tax_percent')) {
                $table->decimal('tax_percent', 8, 2)->default(0)->after('subtotal');
            }
            if (! Schema::hasColumn('invoices', 'tax_amount')) {
                $table->decimal('tax_amount', 18, 2)->default(0)->after('tax_percent');
            }
            if (! Schema::hasColumn('invoices', 'currency')) {
                $table->string('currency', 10)->default('EGP')->after('total');
            }
            if (! Schema::hasColumn('invoices', 'deleted_at')) {
                $table->softDeletes();
            }
        });

        Schema::table('invoice_items', function (Blueprint $table): void {
            if (Schema::hasColumn('invoice_items', 'name') && ! Schema::hasColumn('invoice_items', 'description')) {
                $table->renameColumn('name', 'description');
            }
            if (Schema::hasColumn('invoice_items', 'qty') && ! Schema::hasColumn('invoice_items', 'quantity')) {
                $table->renameColumn('qty', 'quantity');
            }
            if (Schema::hasColumn('invoice_items', 'line_total') && ! Schema::hasColumn('invoice_items', 'total')) {
                $table->renameColumn('line_total', 'total');
            }
        });

        Schema::table('invoice_items', function (Blueprint $table): void {
            if (! Schema::hasColumn('invoice_items', 'description')) {
                $table->string('description')->after('invoice_id');
            }
            if (! Schema::hasColumn('invoice_items', 'quantity')) {
                $table->decimal('quantity', 10, 2)->default(1)->after('description');
            }
            if (! Schema::hasColumn('invoice_items', 'total')) {
                $table->decimal('total', 18, 2)->default(0)->after('unit_price');
            }
        });

        Schema::table('expenses', function (Blueprint $table): void {
            if (! Schema::hasColumn('expenses', 'title')) {
                $table->string('title')->nullable()->after('id');
            }
            if (! Schema::hasColumn('expenses', 'category')) {
                $table->string('category')->nullable()->after('amount');
            }
            if (! Schema::hasColumn('expenses', 'expense_date')) {
                $table->date('expense_date')->nullable()->after('category');
            }
        });

        Schema::table('payments', function (Blueprint $table): void {
            if (! Schema::hasColumn('payments', 'payment_date')) {
                $table->date('payment_date')->nullable()->after('amount');
            }
            if (! Schema::hasColumn('payments', 'method')) {
                $table->string('method')->nullable()->after('payment_date');
            }
        });

        if (! Schema::hasTable('activities')) {
            Schema::create('activities', function (Blueprint $table): void {
                $table->id();
                $table->string('type');
                $table->text('description');
                $table->timestamp('created_at')->useCurrent();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('activities')) {
            Schema::drop('activities');
        }
    }
};
