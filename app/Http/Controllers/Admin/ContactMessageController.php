<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactMessageController extends Controller
{
    public function index(Request $request): View
    {
        $messages = ContactMessage::query()
            ->when($request->filled('q'), fn ($query) => $query->where('name', 'like', '%'.$request->string('q')->toString().'%')
                ->orWhere('email', 'like', '%'.$request->string('q')->toString().'%')
                ->orWhere('message', 'like', '%'.$request->string('q')->toString().'%'))
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')->toString()))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.messages.index', compact('messages'));
    }

    public function show(ContactMessage $message): View
    {
        if ($message->status === 'new') {
            $message->update(['status' => 'read']);
        }

        return view('admin.messages.show', compact('message'));
    }

    public function updateStatus(Request $request, ContactMessage $message): RedirectResponse
    {
        $data = $request->validate(['status' => ['required', 'in:new,read,replied,archived']]);
        $message->update($data);

        return back()->with('success', __('app.saved_successfully'));
    }
}
