<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Category;
use App\Models\Client;
use App\Models\Currency;
use App\Models\Customer;
use App\Models\Expense;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Revenue;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        $egp = Currency::firstOrCreate(['code' => 'EGP'], ['symbol' => 'E£', 'is_base' => true]);
        $usd = Currency::firstOrCreate(['code' => 'USD'], ['symbol' => '$']);

        $account = Account::firstOrCreate(['name' => 'Main Cash'], [
            'type' => 'Cash',
            'currency_id' => $egp->id,
            'opening_balance' => 10000,
        ]);

        $expenseCategory = Category::firstOrCreate(['name' => 'Operations'], ['type' => 'expense']);

        $profile = Profile::firstOrCreate(['name' => 'Mostafa Saeed'], [
            'titles' => [
                'en' => ['Wordpress Developer', 'Laravel Developer', 'Full-Stack Web Developer', 'SEO Specialist', 'Media Buyer', 'Graphic Designer'],
                'ar' => ['مطور ووردبريس', 'مطور لارافيل', 'مطور ويب متكامل', 'اختصاصي سيو', 'مشتري إعلانات', 'مصمم جرافيك'],
            ],
            'bio' => [
                'en' => 'Experienced web developer delivering scalable solutions.',
                'ar' => 'مطور ويب بخبرة في تقديم حلول قابلة للتوسع.',
            ],
            'skills' => ['Laravel', 'WordPress', 'SEO', 'Tailwind'],
        ]);

        Service::firstOrCreate(['title->en' => 'Web Development'], [
            'title' => ['en' => 'Web Development', 'ar' => 'تطوير الويب'],
            'short_description' => ['en' => 'Modern Laravel apps', 'ar' => 'تطبيقات لارافيل حديثة'],
            'description' => ['en' => 'Full-stack development with Laravel.', 'ar' => 'تطوير متكامل باستخدام لارافيل.'],
            'icon' => 'code',
            'display_order' => 1,
        ]);

        $client = Client::firstOrCreate(['name' => 'Acme Corp'], [
            'website' => 'https://example.com',
            'is_featured' => true,
            'display_order' => 1,
        ]);

        Project::firstOrCreate(['slug' => 'portfolio-site'], [
            'title' => ['en' => 'Portfolio Site', 'ar' => 'موقع أعمال'],
            'summary' => ['en' => 'Personal portfolio with CMS.', 'ar' => 'موقع شخصي مع نظام إدارة محتوى.'],
            'case_study' => ['en' => 'Built with Laravel and Tailwind.', 'ar' => 'تم بناؤه باستخدام لارافيل وتيلويند.'],
            'category' => 'Web',
            'client_id' => $client->id,
            'is_featured' => true,
            'is_published' => true,
        ]);

        Setting::firstOrCreate([], [
            'site_name' => ['en' => 'Mostafa Saeed', 'ar' => 'مصطفى سعيد'],
            'base_currency_id' => $egp->id,
        ]);

        $customer = Customer::firstOrCreate(['email' => 'customer@example.com'], [
            'name' => 'Sample Customer',
            'currency_id' => $usd->id,
            'status' => 'active',
        ]);

        $invoice = Invoice::firstOrCreate(['number' => 'INV-0001'], [
            'customer_id' => $customer->id,
            'issue_date' => now()->toDateString(),
            'due_date' => now()->addDays(14)->toDateString(),
            'currency_id' => $usd->id,
            'exchange_rate' => 48.5,
            'status' => 'sent',
            'subtotal' => 1000,
            'total' => 1000,
        ]);

        $invoice->items()->firstOrCreate(['name' => 'Website build'], [
            'quantity' => 1,
            'unit_price' => 1000,
            'line_discount' => 0,
            'line_total' => 1000,
        ]);

        Payment::firstOrCreate(['reference' => 'PAY-001'], [
            'customer_id' => $customer->id,
            'invoice_id' => $invoice->id,
            'amount' => 500,
            'currency_id' => $usd->id,
            'exchange_rate' => 48.5,
            'payment_method' => 'Bank Transfer',
            'account_id' => $account->id,
            'paid_at' => now()->toDateString(),
        ]);

        Expense::firstOrCreate(['vendor' => 'Hosting'], [
            'spent_at' => now()->toDateString(),
            'category_id' => $expenseCategory->id,
            'amount' => 200,
            'currency_id' => $egp->id,
            'exchange_rate' => 1,
            'account_id' => $account->id,
            'notes' => 'Monthly hosting bill',
        ]);

        Revenue::firstOrCreate(['source' => 'Consulting'], [
            'received_at' => now()->toDateString(),
            'amount' => 300,
            'currency_id' => $usd->id,
            'exchange_rate' => 48.5,
            'account_id' => $account->id,
            'notes' => 'Advisory fee',
        ]);
    }
}
