<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExpenseRequest;
use App\Models\Account;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Expense;

class ExpenseController extends Controller
{
    public function index()
    {
        return view('admin.expenses.index', [
            'expenses' => Expense::query()->latest()->get(),
        ]);
    }

    public function create()
    {
        return view('admin.expenses.create', [
            'categories' => Category::query()->where('type', 'expense')->orderBy('name')->get(),
            'currencies' => Currency::query()->orderBy('code')->get(),
            'accounts' => Account::query()->orderBy('name')->get(),
        ]);
    }

    public function store(ExpenseRequest $request)
    {
        Expense::create($request->validated());

        return redirect()->route('admin.expenses.index')->with('status', __('messages.saved'));
    }

    public function edit(Expense $expense)
    {
        return view('admin.expenses.edit', [
            'expense' => $expense,
            'categories' => Category::query()->where('type', 'expense')->orderBy('name')->get(),
            'currencies' => Currency::query()->orderBy('code')->get(),
            'accounts' => Account::query()->orderBy('name')->get(),
        ]);
    }

    public function update(ExpenseRequest $request, Expense $expense)
    {
        $expense->update($request->validated());

        return redirect()->route('admin.expenses.index')->with('status', __('messages.saved'));
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();

        return redirect()->route('admin.expenses.index')->with('status', __('messages.deleted'));
    }
}
