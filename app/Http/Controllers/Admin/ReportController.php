<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ReportService;

class ReportController extends Controller
{
    public function index(ReportService $reportService)
    {
        return view('admin.reports.index', [
            'profitAndLoss' => $reportService->profitAndLoss(),
            'invoiceAging' => $reportService->invoiceAging(),
        ]);
    }
}
