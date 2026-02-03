<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RevenueRequest;
use App\Models\Account;
use App\Models\Currency;
use App\Models\Revenue;

class RevenueController extends Controller
{
    public function index()
    {
        return view('admin.revenues.index', [
            'revenues' => Revenue::query()->latest()->get(),
        ]);
    }

    public function create()
    {
        return view('admin.revenues.create', [
            'currencies' => Currency::query()->orderBy('code')->get(),
            'accounts' => Account::query()->orderBy('name')->get(),
        ]);
    }

    public function store(RevenueRequest $request)
    {
        Revenue::create($request->validated());

        return redirect()->route('admin.revenues.index')->with('status', __('messages.saved'));
    }

    public function edit(Revenue $revenue)
    {
        return view('admin.revenues.edit', [
            'revenue' => $revenue,
            'currencies' => Currency::query()->orderBy('code')->get(),
            'accounts' => Account::query()->orderBy('name')->get(),
        ]);
    }

    public function update(RevenueRequest $request, Revenue $revenue)
    {
        $revenue->update($request->validated());

        return redirect()->route('admin.revenues.index')->with('status', __('messages.saved'));
    }

    public function destroy(Revenue $revenue)
    {
        $revenue->delete();

        return redirect()->route('admin.revenues.index')->with('status', __('messages.deleted'));
    }
}
