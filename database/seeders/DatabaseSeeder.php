<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Client;
use App\Models\Currency;
use App\Models\Expense;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Payment;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Service;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $ownerRole = Role::firstOrCreate(['name' => 'Owner']);
        Role::firstOrCreate(['name' => 'Accountant']);
        Role::firstOrCreate(['name' => 'Content Manager']);
        Role::firstOrCreate(['name' => 'CRM Manager']);

        $user = User::updateOrCreate(
            ['email' => 'admin@mostafasaeed.com'],
            ['name' => 'Mostafa Saeed', 'username' => 'mostafasaeed', 'password' => Hash::make('password')]
        );
        $user->syncRoles([$ownerRole]);

        $egp = Currency::firstOrCreate(['code' => 'EGP'], ['symbol' => 'EGP', 'is_base' => true, 'exchange_rate' => 1, 'enabled' => true]);

        Setting::updateOrCreate(['id' => 1], [
            'site_name' => ['en' => 'Mostafa Saeed', 'ar' => 'مصطفى سعيد'],
            'brand_name' => 'Mostafa Saeed',
            'contact_email' => 'info@mostafasaeed.com',
            'contact_phone' => '01003770730',
            'contact_address' => ['en' => 'Alexandria, Egypt', 'ar' => 'الإسكندرية، مصر'],
            'default_seo' => ['title' => ['en' => 'Mostafa Saeed', 'ar' => 'مصطفى سعيد'], 'description' => ['en' => 'Full Stack Web Developer | WordPress Developer | SEO Specialist | Media Buyer', 'ar' => 'مطور ويب شامل | ووردبريس | سيو | ميديا باير']],
            'base_currency_id' => $egp->id,
            'invoice_prefix' => 'INV-',
            'default_tax_rate' => 14,
        ]);

        Profile::updateOrCreate(['id' => 1], [
            'name' => 'Mostafa Saeed',
            'titles' => ['en' => 'Full Stack Web Developer | WordPress Developer | SEO Specialist | Media Buyer', 'ar' => 'مطور ويب شامل | مطور ووردبريس | متخصص سيو | ميديا باير'],
            'bio' => ['en' => 'Full Stack Web Developer with strong experience in PHP, Laravel, WordPress, SEO, and media buying.', 'ar' => 'مطور ويب شامل بخبرة قوية في PHP وLaravel وWordPress والسيو والميديا باينج.'],
            'skills' => ['PHP & MySQL 90%', 'WordPress 95%', 'Laravel 85%', 'Bootstrap & jQuery 88%', 'SEO 80%', 'HTML & CSS 95%', 'Adobe Photoshop 70%', 'Hosting Management 85%'],
        ]);

        $services = [
            ['Web Development (PHP & Laravel)', 'Custom websites, web apps, APIs'],
            ['WordPress Development', 'Themes, plugins, WooCommerce, and speed optimization'],
            ['SEO Optimization', 'On-page SEO, technical SEO, keyword research, and ranking growth'],
            ['Media Buying', 'Facebook Ads, Google Ads, and campaign management'],
        ];
        foreach ($services as $index => [$title, $desc]) {
            Service::updateOrCreate(['title->en' => $title], [
                'title' => ['en' => $title, 'ar' => $title],
                'short_description' => ['en' => $desc, 'ar' => $desc],
                'description' => ['en' => $desc, 'ar' => $desc],
                'order' => $index + 1,
                'status' => 'published',
            ]);
        }

        $clientsData = [
            ['name' => 'Ahmed Hassan', 'email' => 'ahmed.hassan@deltafoods.eg', 'phone' => '01011111111', 'company' => 'Delta Foods', 'country' => 'Egypt', 'address' => 'Smouha, Alexandria', 'notes' => 'Needs WooCommerce and SEO support.'],
            ['name' => 'Mona Adel', 'email' => 'mona.adel@cairomed.eg', 'phone' => '01022222222', 'company' => 'Cairo Med', 'country' => 'Egypt', 'address' => 'Nasr City, Cairo', 'notes' => 'Healthcare landing pages and ads.'],
            ['name' => 'Karim Fawzy', 'email' => 'karim@horizontravel.eg', 'phone' => '01033333333', 'company' => 'Horizon Travel', 'country' => 'Egypt', 'address' => 'Gleem, Alexandria', 'notes' => 'SEO and lead generation campaigns.'],
            ['name' => 'Nour ElDin', 'email' => 'nour@estatehub.eg', 'phone' => '01044444444', 'company' => 'Estate Hub', 'country' => 'Egypt', 'address' => 'New Cairo, Cairo', 'notes' => 'Laravel CRM dashboard.'],
            ['name' => 'Yasmine Samir', 'email' => 'yasmine@fashionhouse.eg', 'phone' => '01055555555', 'company' => 'Fashion House', 'country' => 'Egypt', 'address' => 'Stanley, Alexandria', 'notes' => 'Brand website and Meta ads.'],
        ];
        $clients = collect($clientsData)->map(fn ($data, $i) => Client::updateOrCreate(['email' => $data['email']], $data + ['featured' => $i < 4, 'order' => $i + 1]));

        $projects = [
            ['client_id' => $clients[0]->id, 'title' => 'Custom Laravel Ordering Platform', 'slug' => 'custom-laravel-ordering-platform', 'description' => 'Laravel based ordering and operations dashboard.', 'category' => 'laravel', 'status' => 'completed', 'budget' => 35000, 'start_date' => now()->subMonths(5), 'end_date' => now()->subMonths(3)],
            ['client_id' => $clients[1]->id, 'title' => 'WordPress Healthcare Website', 'slug' => 'wordpress-healthcare-website', 'description' => 'WordPress website with booking-ready service pages.', 'category' => 'wordpress', 'status' => 'in_progress', 'budget' => 18000, 'start_date' => now()->subMonths(2), 'end_date' => now()->addMonth()],
            ['client_id' => $clients[2]->id, 'title' => 'SEO Growth Campaign', 'slug' => 'seo-growth-campaign', 'description' => 'Technical SEO and keyword expansion campaign.', 'category' => 'seo', 'status' => 'pending', 'budget' => 12000, 'start_date' => now()->startOfMonth(), 'end_date' => now()->addMonths(2)],
            ['client_id' => $clients[4]->id, 'title' => 'Media Buying Funnel', 'slug' => 'media-buying-funnel', 'description' => 'Paid media landing pages and conversion tracking.', 'category' => 'media_buying', 'status' => 'completed', 'budget' => 22000, 'start_date' => now()->subMonths(4), 'end_date' => now()->subMonths(2)],
        ];
        $projectModels = collect($projects)->map(function ($project) {
            return Project::updateOrCreate(['slug' => $project['slug']], [
                'client_id' => $project['client_id'],
                'title' => ['en' => $project['title'], 'ar' => $project['title']],
                'summary' => ['en' => $project['description'], 'ar' => $project['description']],
                'case_study' => ['en' => $project['description'], 'ar' => $project['description']],
                'description' => $project['description'],
                'tech_stack' => ['PHP', 'Laravel', 'WordPress', 'SEO'],
                'category' => $project['category'],
                'status' => $project['status'],
                'budget' => $project['budget'],
                'start_date' => $project['start_date'],
                'end_date' => $project['end_date'],
            ]);
        });

        $invoicePayloads = [
            ['invoice_number' => 'INV-'.now()->year.'-001', 'client_id' => $clients[0]->id, 'project_id' => $projectModels[0]->id, 'status' => 'paid', 'issue_date' => now()->subDays(20), 'due_date' => now()->subDays(10)],
            ['invoice_number' => 'INV-'.now()->year.'-002', 'client_id' => $clients[1]->id, 'project_id' => $projectModels[1]->id, 'status' => 'sent', 'issue_date' => now()->subDays(12), 'due_date' => now()->addDays(3)],
            ['invoice_number' => 'INV-'.now()->year.'-003', 'client_id' => $clients[2]->id, 'project_id' => $projectModels[2]->id, 'status' => 'draft', 'issue_date' => now()->subDays(8), 'due_date' => now()->addDays(7)],
            ['invoice_number' => 'INV-'.now()->year.'-004', 'client_id' => $clients[3]->id, 'project_id' => null, 'status' => 'overdue', 'issue_date' => now()->subDays(30), 'due_date' => now()->subDays(5)],
            ['invoice_number' => 'INV-'.now()->year.'-005', 'client_id' => $clients[4]->id, 'project_id' => $projectModels[3]->id, 'status' => 'paid', 'issue_date' => now()->subDays(15), 'due_date' => now()->subDays(2)],
        ];

        foreach ($invoicePayloads as $index => $payload) {
            $subtotal = [28000, 15000, 9000, 11000, 17500][$index];
            $taxPercent = 14;
            $taxAmount = $subtotal * $taxPercent / 100;
            $total = $subtotal + $taxAmount;
            $paid = in_array($payload['status'], ['paid']) ? $total : 0;

            $invoice = Invoice::updateOrCreate(['invoice_number' => $payload['invoice_number']], $payload + [
                'currency' => 'EGP',
                'subtotal' => $subtotal,
                'tax_percent' => $taxPercent,
                'tax_amount' => $taxAmount,
                'tax' => $taxAmount,
                'total' => $total,
                'paid_amount' => $paid,
                'due_amount' => max($total - $paid, 0),
                'notes' => 'Thank you for your business.',
            ]);

            InvoiceItem::updateOrCreate(['invoice_id' => $invoice->id, 'description' => 'Project milestone payment'], [
                'quantity' => 1,
                'unit_price' => $subtotal,
                'total' => $subtotal,
            ]);

            if ($payload['status'] === 'paid') {
                Payment::updateOrCreate(['invoice_id' => $invoice->id], [
                    'amount' => $total,
                    'payment_date' => now()->subDays(1),
                    'date' => now()->subDays(1),
                    'method' => 'Bank Transfer',
                    'payment_method' => 'Bank Transfer',
                    'notes' => 'Paid in full.',
                ]);
            }
        }

        foreach ([
            ['title' => 'Hosting Renewal', 'amount' => 2200, 'category' => 'Hosting', 'expense_date' => now()->subDays(9), 'notes' => 'Annual VPS renewal'],
            ['title' => 'Meta Ads Budget', 'amount' => 4500, 'category' => 'Advertising', 'expense_date' => now()->subDays(5), 'notes' => 'Lead generation campaign'],
            ['title' => 'Design Assets', 'amount' => 850, 'category' => 'Software', 'expense_date' => now()->subDays(2), 'notes' => 'Premium templates and stock items'],
        ] as $expense) {
            Expense::updateOrCreate(['title' => $expense['title']], $expense + ['date' => $expense['expense_date']]);
        }

        foreach ([
            ['type' => 'invoice', 'description' => 'Invoice INV-'.now()->year.'-001 created'],
            ['type' => 'payment', 'description' => 'Payment received for INV-'.now()->year.'-001'],
            ['type' => 'expense', 'description' => 'Expense added: Hosting Renewal'],
            ['type' => 'project', 'description' => 'New project created: WordPress Healthcare Website'],
            ['type' => 'client', 'description' => 'New client added: Ahmed Hassan'],
        ] as $activity) {
            Activity::create($activity + ['created_at' => now()->subMinutes(rand(1, 600))]);
        }
    }
}
