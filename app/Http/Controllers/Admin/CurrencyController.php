<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CurrencyRequest;
use App\Models\Currency;

class CurrencyController extends Controller
{
    public function index()
    {
        return view('admin.currencies.index', [
            'currencies' => Currency::query()->orderByDesc('is_base')->orderBy('code')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.currencies.create');
    }

    public function store(CurrencyRequest $request)
    {
        $currency = Currency::create($request->validated());

        if ($currency->is_base) {
            Currency::query()->where('id', '!=', $currency->id)->update(['is_base' => false]);
        }

        return redirect()->route('admin.currencies.index')->with('status', __('messages.saved'));
    }

    public function edit(Currency $currency)
    {
        return view('admin.currencies.edit', [
            'currency' => $currency,
        ]);
    }

    public function update(CurrencyRequest $request, Currency $currency)
    {
        $currency->update($request->validated());

        if ($currency->is_base) {
            Currency::query()->where('id', '!=', $currency->id)->update(['is_base' => false]);
        }

        return redirect()->route('admin.currencies.index')->with('status', __('messages.saved'));
    }

    public function destroy(Currency $currency)
    {
        $currency->delete();

        return redirect()->route('admin.currencies.index')->with('status', __('messages.deleted'));
    }
}
