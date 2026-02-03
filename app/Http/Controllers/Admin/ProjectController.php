<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Services\UploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function __construct(private readonly UploadService $uploadService)
    {
    }

    public function index(): View
    {
        $projects = Project::latest()->get();

        return view('admin.projects.index', compact('projects'));
    }

    public function create(): View
    {
        return view('admin.projects.create');
    }

    public function store(ProjectRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request): void {
            $mainImagePath = null;
            if ($request->hasFile('main_image')) {
                $mainImagePath = $this->uploadService->store($request->file('main_image'), 'uploads/projects');
            }

            $techStack = $request->input('tech_stack')
                ? array_map('trim', explode(',', $request->input('tech_stack')))
                : [];

            $project = Project::create([
                'title' => ['en' => $request->string('title_en')->toString(), 'ar' => $request->string('title_ar')->toString()],
                'slug' => $request->string('slug')->toString(),
                'summary' => ['en' => $request->input('summary_en'), 'ar' => $request->input('summary_ar')],
                'case_study' => ['en' => $request->input('case_study_en'), 'ar' => $request->input('case_study_ar')],
                'tech_stack' => $techStack,
                'category' => $request->input('category'),
                'main_image_path' => $mainImagePath,
                'live_url' => $request->input('live_url'),
                'repo_url' => $request->input('repo_url'),
                'metrics' => $request->input('metrics', []),
                'featured' => (bool) $request->input('featured', false),
                'status' => $request->input('status', 'draft'),
                'seo_meta' => [
                    'title' => ['en' => $request->input('seo_title_en'), 'ar' => $request->input('seo_title_ar')],
                    'description' => ['en' => $request->input('seo_description_en'), 'ar' => $request->input('seo_description_ar')],
                ],
            ]);

            if ($request->hasFile('gallery')) {
                foreach ($request->file('gallery', []) as $image) {
                    $path = $this->uploadService->store($image, 'uploads/projects/gallery');
                    ProjectImage::create([
                        'project_id' => $project->id,
                        'path' => $path,
                    ]);
                }
            }
        });

        return redirect()->route('admin.projects.index')->with('success', __('app.saved_successfully'));
    }

    public function edit(Project $project): View
    {
        $project->load('images');

        return view('admin.projects.edit', compact('project'));
    }

    public function update(ProjectRequest $request, Project $project): RedirectResponse
    {
        DB::transaction(function () use ($request, $project): void {
            if ($request->hasFile('main_image')) {
                $this->uploadService->delete($project->main_image_path);
                $project->main_image_path = $this->uploadService->store($request->file('main_image'), 'uploads/projects');
            }

            $techStack = $request->input('tech_stack')
                ? array_map('trim', explode(',', $request->input('tech_stack')))
                : [];

            $project->update([
                'title' => ['en' => $request->string('title_en')->toString(), 'ar' => $request->string('title_ar')->toString()],
                'slug' => $request->string('slug')->toString(),
                'summary' => ['en' => $request->input('summary_en'), 'ar' => $request->input('summary_ar')],
                'case_study' => ['en' => $request->input('case_study_en'), 'ar' => $request->input('case_study_ar')],
                'tech_stack' => $techStack,
                'category' => $request->input('category'),
                'live_url' => $request->input('live_url'),
                'repo_url' => $request->input('repo_url'),
                'metrics' => $request->input('metrics', []),
                'featured' => (bool) $request->input('featured', false),
                'status' => $request->input('status', 'draft'),
                'seo_meta' => [
                    'title' => ['en' => $request->input('seo_title_en'), 'ar' => $request->input('seo_title_ar')],
                    'description' => ['en' => $request->input('seo_description_en'), 'ar' => $request->input('seo_description_ar')],
                ],
            ]);

            if ($request->hasFile('gallery')) {
                foreach ($request->file('gallery', []) as $image) {
                    $path = $this->uploadService->store($image, 'uploads/projects/gallery');
                    ProjectImage::create([
                        'project_id' => $project->id,
                        'path' => $path,
                    ]);
                }
            }
        });

        return redirect()->route('admin.projects.index')->with('success', __('app.saved_successfully'));
    }

    public function destroy(Project $project): RedirectResponse
    {
        $project->load('images');
        $this->uploadService->delete($project->main_image_path);

        foreach ($project->images as $image) {
            $this->uploadService->delete($image->path);
        }

        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', __('app.deleted_successfully'));
    }
}
