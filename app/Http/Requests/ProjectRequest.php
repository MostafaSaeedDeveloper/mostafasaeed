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
            'title_en' => ['required', 'string', 'max:255'],
            'title_ar' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255'],
            'summary_en' => ['nullable', 'string'],
            'summary_ar' => ['nullable', 'string'],
            'case_study_en' => ['nullable', 'string'],
            'case_study_ar' => ['nullable', 'string'],
            'tech_stack' => ['nullable', 'string'],
            'category' => ['nullable', 'string', 'max:120'],
            'main_image' => ['nullable', 'image', 'max:2048'],
            'gallery.*' => ['nullable', 'image', 'max:2048'],
            'live_url' => ['nullable', 'url'],
            'repo_url' => ['nullable', 'url'],
            'metrics' => ['nullable', 'array'],
            'featured' => ['nullable', 'boolean'],
            'status' => ['required', 'in:published,draft'],
            'seo_title_en' => ['nullable', 'string'],
            'seo_title_ar' => ['nullable', 'string'],
            'seo_description_en' => ['nullable', 'string'],
            'seo_description_ar' => ['nullable', 'string'],
        ];
    }
}
