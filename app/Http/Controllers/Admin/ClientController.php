<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Models\Activity;
use App\Models\Client;
use App\Services\UploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClientController extends Controller
{
    public function __construct(private readonly UploadService $uploadService)
    {
    }

    public function index(Request $request): View
    {
        $clients = Client::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search')->toString();
                $query->where(function ($q) use ($search): void {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('company', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%");
                });
            })
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('admin.clients.index', compact('clients'));
    }

    public function create(): View
    {
        return view('admin.clients.create', ['client' => new Client()]);
    }

    public function store(ClientRequest $request): RedirectResponse
    {
        $data = $request->validated();
        if ($request->hasFile('logo')) {
            $data['logo_path'] = $this->uploadService->store($request->file('logo'), 'uploads/clients');
        }
        $client = Client::create($data);
        Activity::create(['type' => 'client', 'description' => "New client added: {$client->name}", 'created_at' => now()]);

        return redirect()->route('admin.clients.index')->with('success', __('app.saved_successfully'));
    }

    public function show(Client $client): View
    {
        $client->load(['projects', 'invoices']);

        return view('admin.clients.show', compact('client'));
    }

    public function edit(Client $client): View
    {
        return view('admin.clients.edit', compact('client'));
    }

    public function update(ClientRequest $request, Client $client): RedirectResponse
    {
        $data = $request->validated();
        if ($request->hasFile('logo')) {
            $this->uploadService->delete($client->logo_path);
            $data['logo_path'] = $this->uploadService->store($request->file('logo'), 'uploads/clients');
        }
        $client->update($data);

        return redirect()->route('admin.clients.index')->with('success', __('app.saved_successfully'));
    }

    public function destroy(Client $client): RedirectResponse
    {
        $client->delete();

        return redirect()->route('admin.clients.index')->with('success', __('app.deleted_successfully'));
    }
}
