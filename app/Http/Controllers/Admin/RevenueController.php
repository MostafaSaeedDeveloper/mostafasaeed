<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Revenue;
use Illuminate\View\View;

class RevenueController extends Controller
{
    public function index(): View
    {
        $revenues = Revenue::with(['category', 'account'])->latest()->paginate(20);

        return view('admin.revenues.index', compact('revenues'));
    }
}
