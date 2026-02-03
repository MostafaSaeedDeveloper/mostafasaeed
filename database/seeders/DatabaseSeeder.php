<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Client;
use App\Models\ContactMessage;
use App\Models\Currency;
use App\Models\Customer;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\IncomeCategory;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Payment;
use App\Models\Profile;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\Revenue;
use App\Models\Service;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $ownerRole = Role::firstOrCreate(['name' => 'Owner']);
        Role::firstOrCreate(['name' => 'Accountant']);
        Role::firstOrCreate(['name' => 'Content Manager']);
        Role::firstOrCreate(['name' => 'CRM Manager']);

        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Admin User', 'password' => Hash::make('password')]
        );
        $admin->assignRole($ownerRole);

        $egp = Currency::firstOrCreate(['code' => 'EGP'], ['symbol' => 'EGP', 'is_base' => true, 'exchange_rate' => 1]);
        $usd = Currency::firstOrCreate(['code' => 'USD'], ['symbol' => '$', 'exchange_rate' => 0.032]);
        $eur = Currency::firstOrCreate(['code' => 'EUR'], ['symbol' => '€', 'exchange_rate' => 0.03]);

        $cash = Account::firstOrCreate(['name' => 'Cash'], ['type' => 'cash', 'currency_id' => $egp->id]);
        $bank = Account::firstOrCreate(['name' => 'Bank'], ['type' => 'bank', 'currency_id' => $egp->id]);

        $expenseCategory = ExpenseCategory::firstOrCreate(['name' => 'Marketing']);
        $incomeCategory = IncomeCategory::firstOrCreate(['name' => 'Projects']);

        Setting::firstOrCreate([], [
            'site_name' => ['en' => 'Mostafa Saeed', 'ar' => 'مصطفى سعيد'],
            'contact_email' => 'hello@example.com',
            'contact_phone' => '+20 100 000 0000',
            'default_seo' => [
                'title' => ['en' => 'Mostafa Saeed', 'ar' => 'مصطفى سعيد'],
                'description' => ['en' => 'Personal website and portfolio', 'ar' => 'موقع شخصي وبورتفوليو'],
            ],
            'base_currency_id' => $egp->id,
        ]);

        Profile::firstOrCreate([], [
            'name' => 'Mostafa Saeed',
            'titles' => ['en' => 'FullStack Web Developer', 'ar' => 'مطور ويب شامل'],
            'bio' => ['en' => 'Senior developer specializing in Laravel and WordPress.', 'ar' => 'مطوّر خبير متخصص في لارافيل ووردبريس.'],
            'skills' => ['Laravel', 'WordPress', 'SEO', 'Media Buying'],
        ]);

        Service::firstOrCreate(['title->en' => 'Web Development'], [
            'title' => ['en' => 'Web Development', 'ar' => 'تطوير المواقع'],
            'short_description' => ['en' => 'Modern websites and apps.', 'ar' => 'مواقع وتطبيقات حديثة.'],
            'description' => ['en' => 'Building high performance web applications.', 'ar' => 'بناء تطبيقات ويب عالية الأداء.'],
            'order' => 1,
            'status' => 'published',
        ]);

        Service::firstOrCreate(['title->en' => 'SEO'], [
            'title' => ['en' => 'SEO', 'ar' => 'تحسين محركات البحث'],
            'short_description' => ['en' => 'Rank higher on search.', 'ar' => 'تحسين ترتيبك في البحث.'],
            'description' => ['en' => 'Search engine optimization and audits.', 'ar' => 'تحسين محركات البحث والتدقيق.'],
            'order' => 2,
            'status' => 'published',
        ]);

        Service::firstOrCreate(['title->en' => 'Social Media Management'], [
            'title' => ['en' => 'Social Media Management', 'ar' => 'إدارة وسائل التواصل'],
            'short_description' => ['en' => 'Content plans and growth.', 'ar' => 'خطط محتوى ونمو.'],
            'description' => ['en' => 'Social media strategy and analytics.', 'ar' => 'استراتيجية وإحصائيات التواصل.'],
            'order' => 3,
            'status' => 'published',
        ]);

        Service::firstOrCreate(['title->en' => 'Media Buying'], [
            'title' => ['en' => 'Media Buying', 'ar' => 'شراء الوسائط'],
            'short_description' => ['en' => 'Optimized ad campaigns.', 'ar' => 'حملات إعلانية محسنة.'],
            'description' => ['en' => 'Paid ads across platforms.', 'ar' => 'إعلانات مدفوعة عبر المنصات.'],
            'order' => 4,
            'status' => 'published',
        ]);

        Service::firstOrCreate(['title->en' => 'Data Entry'], [
            'title' => ['en' => 'Data Entry', 'ar' => 'إدخال البيانات'],
            'short_description' => ['en' => 'Accurate data processing.', 'ar' => 'إدخال بيانات بدقة.'],
            'description' => ['en' => 'Fast and reliable data entry.', 'ar' => 'إدخال بيانات سريع وموثوق.'],
            'order' => 5,
            'status' => 'published',
        ]);

        $customers = [
            Customer::firstOrCreate(['email' => 'client@example.com'], [
                'name' => 'Acme Co.',
                'company_name' => 'Acme Co.',
                'phone' => '+20 111 111 1111',
                'default_currency_id' => $egp->id,
            ]),
            Customer::firstOrCreate(['email' => 'hello@northwind.test'], [
                'name' => 'Northwind',
                'company_name' => 'Northwind',
                'phone' => '+20 222 222 2222',
                'default_currency_id' => $usd->id,
            ]),
            Customer::firstOrCreate(['email' => 'contact@contoso.test'], [
                'name' => 'Contoso',
                'company_name' => 'Contoso',
                'phone' => '+20 333 333 3333',
                'default_currency_id' => $eur->id,
            ]),
        ];

        $projectsData = [
            ['slug' => 'ecommerce-platform', 'title_en' => 'Ecommerce Platform', 'title_ar' => 'منصة تجارة إلكترونية', 'status' => 'published'],
            ['slug' => 'corporate-website', 'title_en' => 'Corporate Website', 'title_ar' => 'موقع شركة', 'status' => 'published'],
            ['slug' => 'booking-system', 'title_en' => 'Booking System', 'title_ar' => 'نظام حجوزات', 'status' => 'draft'],
            ['slug' => 'portfolio-brand', 'title_en' => 'Portfolio Brand', 'title_ar' => 'هوية بصرية', 'status' => 'published'],
            ['slug' => 'seo-campaign', 'title_en' => 'SEO Campaign', 'title_ar' => 'حملة سيو', 'status' => 'published'],
            ['slug' => 'media-buying', 'title_en' => 'Media Buying Dashboard', 'title_ar' => 'لوحة شراء الوسائط', 'status' => 'draft'],
        ];

        foreach ($projectsData as $index => $data) {
            $project = Project::firstOrCreate(['slug' => $data['slug']], [
                'title' => ['en' => $data['title_en'], 'ar' => $data['title_ar']],
                'summary' => ['en' => 'Project summary', 'ar' => 'ملخص المشروع'],
                'case_study' => ['en' => 'Project case study', 'ar' => 'دراسة حالة المشروع'],
                'tech_stack' => ['Laravel', 'Bootstrap', 'MySQL'],
                'category' => 'Web',
                'featured' => $index < 2,
                'status' => $data['status'],
                'customer_id' => $customers[$index % 3]->id,
            ]);

            ProjectImage::firstOrCreate(['project_id' => $project->id, 'path' => '/uploads/projects/gallery/sample-'.$project->id.'.jpg']);
        }

        $clients = ['Acme Co.', 'Northwind', 'Contoso', 'Globex', 'Initech', 'Umbrella'];
        foreach ($clients as $index => $clientName) {
            Client::firstOrCreate(['name' => $clientName], [
                'featured' => $index < 4,
                'order' => $index + 1,
            ]);
        }

        $invoice = Invoice::firstOrCreate(['invoice_number' => 1000], [
            'customer_id' => $customers[0]->id,
            'issue_date' => now()->subDays(10),
            'due_date' => now()->addDays(10),
            'currency_id' => $egp->id,
            'exchange_rate_to_base' => 1,
            'status' => 'sent',
            'subtotal' => 10000,
            'discount' => 0,
            'tax' => 0,
            'total' => 10000,
        ]);

        InvoiceItem::firstOrCreate(['invoice_id' => $invoice->id, 'name' => 'Web Development'], [
            'qty' => 1,
            'unit_price' => 10000,
            'line_total' => 10000,
        ]);

        Payment::firstOrCreate(['invoice_id' => $invoice->id], [
            'customer_id' => $customers[0]->id,
            'amount' => 3000,
            'currency_id' => $egp->id,
            'exchange_rate_to_base' => 1,
            'payment_method' => 'Bank',
            'account_id' => $bank->id,
            'date' => now()->subDays(2),
        ]);

        Expense::firstOrCreate(['notes' => 'Hosting'], [
            'date' => now()->subDays(5),
            'expense_category_id' => $expenseCategory->id,
            'amount' => 500,
            'currency_id' => $egp->id,
            'exchange_rate_to_base' => 1,
            'account_id' => $cash->id,
            'vendor' => 'Hosting Provider',
        ]);

        Revenue::firstOrCreate(['source' => 'Consulting'], [
            'date' => now()->subDays(3),
            'income_category_id' => $incomeCategory->id,
            'amount' => 2000,
            'currency_id' => $egp->id,
            'exchange_rate_to_base' => 1,
            'account_id' => $cash->id,
        ]);

        ContactMessage::firstOrCreate(['email' => 'lead@example.com'], [
            'name' => 'New Lead',
            'service' => 'Web Development',
            'message' => 'Need a new website.',
        ]);
    }
}
