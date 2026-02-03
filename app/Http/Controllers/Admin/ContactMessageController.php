<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;

class ContactMessageController extends Controller
{
    public function index()
    {
        return view('admin.contacts.index', [
            'messages' => ContactMessage::query()->latest()->get(),
        ]);
    }

    public function show(ContactMessage $contactMessage)
    {
        return view('admin.contacts.show', [
            'message' => $contactMessage,
        ]);
    }

    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();

        return redirect()->route('admin.contacts.index')->with('status', __('messages.deleted'));
    }
}
