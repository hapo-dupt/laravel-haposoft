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
        $listProject = auth()->user()->projects()->paginate(config('app.pagination'));
        return view('members.projects.projects', ['projects' => $listProject]);
    }

    /**
     * Show details of projects
     * @param $projectId
     * @return Factory|View
     */
    public function show($projectId)
    {
        $dataProjects = Project::findorFail($projectId);
        $process = $dataProjects->process_data;
        $contentProject = [
            'process' => $process,
            'projectDetail' => $dataProjects,
            'customer' => $dataProjects->customers,
            'member' => $dataProjects->members
        ];
        return view('members.projects.details', $contentProject);
    }

    /**
     * Show Tasks from id project.
     * @param $projectId
     * @return Factory|View
     */
    public function showTask($projectId)
    {
        $titleProject = Project::findorFail($projectId)->title;
        $listTask = auth()->user()->tasks()->where('project_id', $projectId)->paginate(config('app.pagination'));
        $dataTask = [
            'listTask' => $listTask,
            'orderId' => Member::ID,
            'project_id' => $projectId,
            'paginate' => config('app.pagination'),
            'titleProject' => $titleProject
        ];
        return view('members.tasks.tasks', ['dataTask' => $dataTask]);
    }
}
