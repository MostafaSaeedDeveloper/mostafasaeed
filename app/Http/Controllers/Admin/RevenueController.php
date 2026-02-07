<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Currency;
use App\Models\IncomeCategory;
use App\Models\Revenue;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RevenueController extends Controller
{
    public function index(Request $request): View
    {
        $revenues = Revenue::with(['category', 'account'])
            ->when($request->filled('income_category_id'), fn ($query) => $query->where('income_category_id', $request->integer('income_category_id')))
            ->when($request->filled('from'), fn ($query) => $query->whereDate('date', '>=', $request->date('from')))
            ->when($request->filled('to'), fn ($query) => $query->whereDate('date', '<=', $request->date('to')))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        $categories = IncomeCategory::orderBy('name')->get();

        return view('admin.revenues.index', compact('revenues', 'categories'));
    }

    public function create(): View
    {
        return view('admin.revenues.create', $this->formData(new Revenue(['date' => now()->toDateString()])));
    }

    public function store(Request $request): RedirectResponse
    {
        Revenue::create($this->validated($request));

        return redirect()->route('admin.revenues.index')->with('success', __('app.saved_successfully'));
    }

    public function edit(Revenue $revenue): View
    {
        return view('admin.revenues.edit', $this->formData($revenue));
    }

    public function update(Request $request, Revenue $revenue): RedirectResponse
    {
        $revenue->update($this->validated($request));

        return redirect()->route('admin.revenues.index')->with('success', __('app.saved_successfully'));
    }

    public function destroy(Revenue $revenue): RedirectResponse
    {
        $revenue->delete();

        return redirect()->route('admin.revenues.index')->with('success', __('app.deleted_successfully'));
    }

    private function formData(Revenue $revenue): array
    {
        return [
            'revenue' => $revenue,
            'categories' => IncomeCategory::orderBy('name')->get(),
            'accounts' => Account::orderBy('name')->get(),
            'currencies' => Currency::orderBy('code')->get(),
        ];
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'date' => ['required', 'date'],
            'income_category_id' => ['nullable', 'exists:income_categories,id'],
            'source' => ['nullable', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'currency_id' => ['nullable', 'exists:currencies,id'],
            'exchange_rate_to_base' => ['nullable', 'numeric', 'min:0.000001'],
            'account_id' => ['nullable', 'exists:accounts,id'],
            'notes' => ['nullable', 'string'],
        ]);
    }
}
