<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use App\Services\UploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PaymentMethodController extends Controller
{
    public function __construct(private readonly UploadService $uploadService)
    {
    }

    public function index(): View
    {
        $methods = PaymentMethod::latest()->paginate(15);

        return view('admin.payment-methods.index', compact('methods'));
    }

    public function create(): View
    {
        return view('admin.payment-methods.create', ['method' => new PaymentMethod(['is_active' => true])]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['slug'] = Str::slug($data['name']).'-'.Str::random(4);
        $data['is_default'] = $request->boolean('is_default');
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('logo')) {
            $data['logo_path'] = $this->uploadService->store($request->file('logo'), 'uploads/payment-methods');
        }

        if ($data['is_default']) {
            PaymentMethod::query()->update(['is_default' => false]);
        }

        PaymentMethod::create($data);

        return redirect()->route('admin.payment-methods.index')->with('success', __('app.saved_successfully'));
    }

    public function edit(PaymentMethod $paymentMethod): View
    {
        return view('admin.payment-methods.edit', ['method' => $paymentMethod]);
    }

    public function update(Request $request, PaymentMethod $paymentMethod): RedirectResponse
    {
        $data = $this->validated($request);
        $data['is_default'] = $request->boolean('is_default');
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('logo')) {
            $this->uploadService->delete($paymentMethod->logo_path);
            $data['logo_path'] = $this->uploadService->store($request->file('logo'), 'uploads/payment-methods');
        }

        if ($data['is_default']) {
            PaymentMethod::whereKeyNot($paymentMethod->id)->update(['is_default' => false]);
        }

        $paymentMethod->update($data);

        return redirect()->route('admin.payment-methods.index')->with('success', __('app.saved_successfully'));
    }

    public function destroy(PaymentMethod $paymentMethod): RedirectResponse
    {
        $this->uploadService->delete($paymentMethod->logo_path);
        $paymentMethod->delete();

        return redirect()->route('admin.payment-methods.index')->with('success', __('app.deleted_successfully'));
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'customer_label' => ['nullable', 'string', 'max:150'],
            'description' => ['nullable', 'string'],
            'instructions' => ['nullable', 'string'],
            'logo' => ['nullable', 'image', 'max:2048'],
        ]);
    }
}
