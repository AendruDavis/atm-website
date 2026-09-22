<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Contracts\View\View;

class ProjectController extends Controller
{
    public function index(): View
    {
        return view('projects.index', [
            'projects' => Project::published()->with(['category', 'featuredImage'])->orderByDesc('is_featured')->orderBy('sort_order')->orderByDesc('id')->paginate(9),
        ]);
    }

    public function show(Project $project): View
    {
        abort_unless(Project::published()->whereKey($project->getKey())->exists(), 404);

        return view('projects.show', ['project' => $project->load(['category', 'featuredImage', 'services'])]);
    }
}
