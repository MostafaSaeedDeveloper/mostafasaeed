<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'client_id' => ['required', 'exists:clients,id'],
            'title_en' => ['required', 'string', 'max:255'],
            'title_ar' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'summary_en' => ['nullable', 'string'],
            'summary_ar' => ['nullable', 'string'],
            'case_study_en' => ['nullable', 'string'],
            'case_study_ar' => ['nullable', 'string'],
            'tech_stack' => ['nullable', 'string'],
            'category' => ['required', 'in:laravel,wordpress,seo,media_buying,other'],
            'main_image' => ['nullable', 'image', 'max:2048'],
            'status' => ['required', 'in:pending,in_progress,completed,cancelled'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date'],
            'budget' => ['nullable', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string'],
            'featured' => ['nullable', 'boolean'],
            'live_url' => ['nullable', 'url'],
            'repo_url' => ['nullable', 'url'],
            'seo_title_en' => ['nullable', 'string'],
            'seo_title_ar' => ['nullable', 'string'],
            'seo_description_en' => ['nullable', 'string'],
            'seo_description_ar' => ['nullable', 'string'],
        ];
    }
}
