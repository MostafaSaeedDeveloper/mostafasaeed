<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\View\View;

class ExpenseController extends Controller
{
    public function index(): View
    {
        $expenses = Expense::with(['category', 'account'])->latest()->paginate(20);

        return view('admin.expenses.index', compact('expenses'));
    }
}
