<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Expense;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExpenseController extends Controller
{
    public function index(Request $request): View
    {
        $expenses = Expense::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search')->toString();
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            })
            ->latest('expense_date')
            ->paginate(10)
            ->withQueryString();

        return view('admin.expenses.index', [
            'expenses' => $expenses,
            'totalAmount' => $expenses->getCollection()->sum('amount'),
        ]);
    }

    public function create(): View
    {
        return view('admin.expenses.create', ['expense' => new Expense(['expense_date' => now()->toDateString()])]);
    }

    public function store(Request $request): RedirectResponse
    {
        $expense = Expense::create($this->validated($request));
        Activity::create(['type' => 'expense', 'description' => "Expense added: {$expense->title}", 'created_at' => now()]);

        return redirect()->route('admin.expenses.index')->with('success', __('app.saved_successfully'));
    }

    public function edit(Expense $expense): View
    {
        return view('admin.expenses.edit', compact('expense'));
    }

    public function update(Request $request, Expense $expense): RedirectResponse
    {
        $expense->update($this->validated($request));

        return redirect()->route('admin.expenses.index')->with('success', __('app.saved_successfully'));
    }

    public function destroy(Expense $expense): RedirectResponse
    {
        $expense->delete();

        return redirect()->route('admin.expenses.index')->with('success', __('app.deleted_successfully'));
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'category' => ['required', 'string', 'max:255'],
            'expense_date' => ['required', 'date'],
            'notes' => ['nullable', 'string'],
        ]);
        $data['date'] = $data['expense_date'];

        return $data;
    }
}
