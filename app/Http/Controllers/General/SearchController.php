<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    protected $optionProject = 1;

    /**
     * Search result by key word
     * @param Request $request
     * @return Factory|View
     */
    public function search(Request $request)
    {
        $task = auth()->user()->tasks()->where('title', 'like', "%$request->keyword%")
            ->orWhere('description', 'like', "%$request->keyword%")->paginate(config('app.pagination'));
        return view('generals.resultSearch', ['data' => $task]);
    }
}
