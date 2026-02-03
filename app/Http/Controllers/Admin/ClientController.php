<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Models\Client;

class ClientController extends Controller
{
    public function index()
    {
        return view('admin.clients.index', [
            'clients' => Client::query()->orderBy('display_order')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.clients.create');
    }

    public function store(ClientRequest $request)
    {
        Client::create($request->validated());

        return redirect()->route('admin.clients.index')->with('status', __('messages.saved'));
    }

    public function edit(Client $client)
    {
        return view('admin.clients.edit', [
            'client' => $client,
        ]);
    }

    public function update(ClientRequest $request, Client $client)
    {
        $client->update($request->validated());

        return redirect()->route('admin.clients.index')->with('status', __('messages.saved'));
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('admin.clients.index')->with('status', __('messages.deleted'));
    }
}
