<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Activity;
use App\Models\Client;
use App\Models\Project;
use App\Services\UploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function __construct(private readonly UploadService $uploadService)
    {
    }

    public function index(Request $request): View
    {
        $projects = Project::with('client')
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search')->toString();
                $query->where(function ($q) use ($search): void {
                    $q->where('title->en', 'like', "%{$search}%")
                        ->orWhere('title->ar', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')))
            ->when($request->filled('category'), fn ($query) => $query->where('category', $request->string('category')))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.projects.index', [
            'projects' => $projects,
            'clients' => Client::orderBy('name')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.projects.create', ['project' => new Project(), 'clients' => Client::orderBy('name')->get()]);
    }

    public function store(ProjectRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request): void {
            $data = $this->payload($request);
            if ($request->hasFile('main_image')) {
                $data['main_image_path'] = $this->uploadService->store($request->file('main_image'), 'uploads/projects');
            }
            $project = Project::create($data);
            Activity::create(['type' => 'project', 'description' => "New project created: ".$project->getTranslated('title'), 'created_at' => now()]);
        });

        return redirect()->route('admin.projects.index')->with('success', __('app.saved_successfully'));
    }

    public function show(Project $project): View
    {
        $project->load(['client', 'invoices']);

        return view('admin.projects.show', compact('project'));
    }

    public function edit(Project $project): View
    {
        return view('admin.projects.edit', compact('project') + ['clients' => Client::orderBy('name')->get()]);
    }

    public function update(ProjectRequest $request, Project $project): RedirectResponse
    {
        $data = $this->payload($request);
        if ($request->hasFile('main_image')) {
            $this->uploadService->delete($project->main_image_path);
            $data['main_image_path'] = $this->uploadService->store($request->file('main_image'), 'uploads/projects');
        }
        $project->update($data);

        return redirect()->route('admin.projects.index')->with('success', __('app.saved_successfully'));
    }

    public function destroy(Project $project): RedirectResponse
    {
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', __('app.deleted_successfully'));
    }

    private function payload(ProjectRequest $request): array
    {
        $titleEn = $request->string('title_en')->toString();

        return [
            'client_id' => $request->input('client_id'),
            'title' => ['en' => $titleEn, 'ar' => $request->string('title_ar')->toString()],
            'slug' => $request->input('slug') ?: Str::slug($titleEn),
            'description' => $request->input('description'),
            'summary' => ['en' => $request->input('summary_en'), 'ar' => $request->input('summary_ar')],
            'case_study' => ['en' => $request->input('case_study_en'), 'ar' => $request->input('case_study_ar')],
            'tech_stack' => $request->input('tech_stack') ? array_map('trim', explode(',', $request->input('tech_stack'))) : [],
            'category' => $request->input('category'),
            'status' => $request->input('status'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'budget' => $request->input('budget', 0),
            'notes' => $request->input('notes'),
            'featured' => (bool) $request->input('featured', false),
            'live_url' => $request->input('live_url'),
            'repo_url' => $request->input('repo_url'),
            'seo_meta' => [
                'title' => ['en' => $request->input('seo_title_en'), 'ar' => $request->input('seo_title_ar')],
                'description' => ['en' => $request->input('seo_description_en'), 'ar' => $request->input('seo_description_ar')],
            ],
        ];
    }
}
