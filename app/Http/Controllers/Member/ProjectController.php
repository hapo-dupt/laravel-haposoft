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
        $project = auth()->user()->projects()->paginate(config('app.pagination'));
        return view('members.projects.projects', ['projects' => $project]);
    }

    /**
     * Show details of projects
     * @param $projectId
     * @return Factory|View
     */
    public function show($projectId)
    {
        $projects = Project::findorFail($projectId);
        $process = $projects->process_data;
        $projectContent = [
            'process' => $process,
            'projectDetail' => $projects,
            'customer' => $projects->customers,
            'member' => $projects->members
        ];
        return view('members.projects.details', $projectContent);
    }

    /**
     * Show Tasks from id project.
     * @param $projectId
     * @return Factory|View
     */
    public function showTask($projectId)
    {
        $projectTitle = Project::findorFail($projectId)->title;
        $taskList = auth()->user()->tasks()->where('project_id', $projectId)->paginate(config('app.pagination'));
        $dataTask = [
            'taskList' => $taskList,
            'orderId' => Member::ID,
            'projectId' => $projectId,
            'paginate' => config('app.pagination'),
            'projectTitle' => $projectTitle
        ];
        return view('members.tasks.tasks', $dataTask);
    }
}
