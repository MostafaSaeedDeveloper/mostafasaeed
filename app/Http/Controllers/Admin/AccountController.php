<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountRequest;
use App\Models\Account;
use App\Models\Currency;

class AccountController extends Controller
{
    public function index()
    {
        return view('admin.accounts.index', [
            'accounts' => Account::query()->orderBy('name')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.accounts.create', [
            'currencies' => Currency::query()->orderBy('code')->get(),
        ]);
    }

    public function store(AccountRequest $request)
    {
        Account::create($request->validated());

        return redirect()->route('admin.accounts.index')->with('status', __('messages.saved'));
    }

    public function edit(Account $account)
    {
        return view('admin.accounts.edit', [
            'account' => $account,
            'currencies' => Currency::query()->orderBy('code')->get(),
        ]);
    }

    public function update(AccountRequest $request, Account $account)
    {
        $account->update($request->validated());

        return redirect()->route('admin.accounts.index')->with('status', __('messages.saved'));
    }

    public function destroy(Account $account)
    {
        $account->delete();

        return redirect()->route('admin.accounts.index')->with('status', __('messages.deleted'));
    }
}
