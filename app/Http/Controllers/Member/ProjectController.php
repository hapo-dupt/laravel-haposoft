<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Project as Project;
use App\Models\Task;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    /**
     * Return view projects
     */
    public function index()
    {
        $projects = auth()->user()->projects()->paginate(config('app.pagination'));
        return view('members.projects.projects', ['projects' => $projects]);
    }

    /**
     * Show details of projects
     * @param $projectId
     * @return Factory|View
     */
    public function show($projectId)
    {
        $project = Project::findorFail($projectId);
        $process = $project->process_data;
        $projectContents = [
            'process' => $process,
            'project' => $project,
            'customer' => $project->customers,
            'member' => $project->members
        ];
        return view('members.projects.details', $projectContents);
    }

    /**
     * Show Tasks from id project.
     * @param $projectId
     * @return Factory|View
     */
    public function showTask($projectId)
    {
        $projectTitle = Project::findorFail($projectId)->title;
        $tasks = auth()->user()->tasks()->where('project_id', $projectId)->paginate(config('app.pagination'));
        $dataTasks = [
            'tasks' => $tasks,
            'orderId' => Member::ID,
            'projectId' => $projectId,
            'paginate' => config('app.pagination'),
            'projectTitle' => $projectTitle
        ];
        return view('members.tasks.tasks', $dataTasks);
    }
}
