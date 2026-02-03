<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function index(): View
    {
        $payments = Payment::with(['customer', 'invoice'])->latest()->paginate(20);

        return view('admin.payments.index', compact('payments'));
    }
}
