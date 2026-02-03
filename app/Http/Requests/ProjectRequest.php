<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $projectId = $this->route('project')?->id;

        return [
            'title.en' => ['required', 'string', 'max:255'],
            'title.ar' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('projects', 'slug')->ignore($projectId)],
            'summary.en' => ['nullable', 'string', 'max:500'],
            'summary.ar' => ['nullable', 'string', 'max:500'],
            'case_study.en' => ['nullable', 'string'],
            'case_study.ar' => ['nullable', 'string'],
            'tech_stack' => ['nullable', 'array'],
            'category' => ['nullable', 'string', 'max:255'],
            'client_id' => ['nullable', 'exists:clients,id'],
            'live_url' => ['nullable', 'url', 'max:255'],
            'repo_url' => ['nullable', 'url', 'max:255'],
            'metrics' => ['nullable', 'array'],
            'is_featured' => ['boolean'],
            'is_published' => ['boolean'],
        ];
    }
}
