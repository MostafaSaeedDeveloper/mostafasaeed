<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Services\UploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ClientController extends Controller
{
    public function __construct(private readonly UploadService $uploadService)
    {
    }

    public function index(): View
    {
        $clients = Client::orderBy('order')->get();

        return view('admin.clients.index', compact('clients'));
    }

    public function create(): View
    {
        return view('admin.clients.create');
    }

    public function store(ClientRequest $request): RedirectResponse
    {
        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $this->uploadService->store($request->file('logo'), 'uploads/clients');
        }

        Client::create([
            'name' => $request->string('name')->toString(),
            'logo_path' => $logoPath,
            'website' => $request->input('website'),
            'featured' => (bool) $request->input('featured', false),
            'order' => $request->input('order', 0),
        ]);

        return redirect()->route('admin.clients.index')->with('success', __('app.saved_successfully'));
    }

    public function edit(Client $client): View
    {
        return view('admin.clients.edit', compact('client'));
    }

    public function update(ClientRequest $request, Client $client): RedirectResponse
    {
        if ($request->hasFile('logo')) {
            $this->uploadService->delete($client->logo_path);
            $client->logo_path = $this->uploadService->store($request->file('logo'), 'uploads/clients');
        }

        $client->update([
            'name' => $request->string('name')->toString(),
            'logo_path' => $client->logo_path,
            'website' => $request->input('website'),
            'featured' => (bool) $request->input('featured', false),
            'order' => $request->input('order', 0),
        ]);

        return redirect()->route('admin.clients.index')->with('success', __('app.saved_successfully'));
    }

    public function destroy(Client $client): RedirectResponse
    {
        $this->uploadService->delete($client->logo_path);
        $client->delete();

        return redirect()->route('admin.clients.index')->with('success', __('app.deleted_successfully'));
    }
}
