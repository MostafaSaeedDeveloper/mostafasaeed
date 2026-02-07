<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Currency;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Services\UploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExpenseController extends Controller
{
    public function __construct(private readonly UploadService $uploadService)
    {
    }

    public function index(Request $request): View
    {
        $expenses = Expense::with(['category', 'account'])
            ->when($request->filled('expense_category_id'), fn ($query) => $query->where('expense_category_id', $request->integer('expense_category_id')))
            ->when($request->filled('from'), fn ($query) => $query->whereDate('date', '>=', $request->date('from')))
            ->when($request->filled('to'), fn ($query) => $query->whereDate('date', '<=', $request->date('to')))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        $categories = ExpenseCategory::orderBy('name')->get();

        return view('admin.expenses.index', compact('expenses', 'categories'));
    }

    public function create(): View
    {
        return view('admin.expenses.create', $this->formData(new Expense(['date' => now()->toDateString()])));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        if ($request->hasFile('receipt')) {
            $data['receipt_path'] = $this->uploadService->store($request->file('receipt'), 'uploads/expenses');
        }
        Expense::create($data);

        return redirect()->route('admin.expenses.index')->with('success', __('app.saved_successfully'));
    }

    public function edit(Expense $expense): View
    {
        return view('admin.expenses.edit', $this->formData($expense));
    }

    public function update(Request $request, Expense $expense): RedirectResponse
    {
        $data = $this->validated($request);
        if ($request->hasFile('receipt')) {
            $this->uploadService->delete($expense->receipt_path);
            $data['receipt_path'] = $this->uploadService->store($request->file('receipt'), 'uploads/expenses');
        }

        $expense->update($data);

        return redirect()->route('admin.expenses.index')->with('success', __('app.saved_successfully'));
    }

    public function destroy(Expense $expense): RedirectResponse
    {
        $this->uploadService->delete($expense->receipt_path);
        $expense->delete();

        return redirect()->route('admin.expenses.index')->with('success', __('app.deleted_successfully'));
    }

    private function formData(Expense $expense): array
    {
        return [
            'expense' => $expense,
            'categories' => ExpenseCategory::orderBy('name')->get(),
            'accounts' => Account::orderBy('name')->get(),
            'currencies' => Currency::orderBy('code')->get(),
        ];
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'date' => ['required', 'date'],
            'expense_category_id' => ['nullable', 'exists:expense_categories,id'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'currency_id' => ['nullable', 'exists:currencies,id'],
            'exchange_rate_to_base' => ['nullable', 'numeric', 'min:0.000001'],
            'account_id' => ['nullable', 'exists:accounts,id'],
            'vendor' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
            'receipt' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
        ]);
    }
}
