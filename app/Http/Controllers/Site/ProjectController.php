<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        return view('site.projects', [
            'projects' => Project::query()->where('is_published', true)->orderByDesc('is_featured')->get(),
        ]);
    }

    public function show(Project $project)
    {
        return view('site.project-show', [
            'project' => $project->load('images', 'client'),
        ]);
    }
}
