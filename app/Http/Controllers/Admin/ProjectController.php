<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Client;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        return view('admin.projects.index', [
            'projects' => Project::query()->latest()->get(),
        ]);
    }

    public function create()
    {
        return view('admin.projects.create', [
            'clients' => Client::query()->orderBy('name')->get(),
        ]);
    }

    public function store(ProjectRequest $request)
    {
        Project::create($request->validated());

        return redirect()->route('admin.projects.index')->with('status', __('messages.saved'));
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', [
            'project' => $project,
            'clients' => Client::query()->orderBy('name')->get(),
        ]);
    }

    public function update(ProjectRequest $request, Project $project)
    {
        $project->update($request->validated());

        return redirect()->route('admin.projects.index')->with('status', __('messages.saved'));
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index')->with('status', __('messages.deleted'));
    }
}
