<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Show Select Project to view tasks.
     */
    public function index()
    {
        $selectProjects = auth()->user()->projects()->paginate(config('app.pagination'));
        return view('members.tasks.index', ['selectProjects' => $selectProjects]);
    }

    /**
     * Complete Tasks
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request)
    {
        $taskMember = Task::find($request->task_id)->member_id;
        if ($taskMember == auth()->user()->id) {
            Task::findorFail($request->task_id)->update(['status' => Member::STATUS_CLOSE]);
            return redirect()->route('tasks.show_task', $request->project_id)
                ->with('success', trans('message.task_success'));
        } else {
            return redirect()->route('tasks.show_task', $request->project_id)
                ->with('error', trans('message.task_error'));
        }
    }
}
