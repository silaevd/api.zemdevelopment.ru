<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;

/**
 * Class ManagerController
 * @package App\Http\Controllers
 */
class ManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('manager.index');
    }

    public function project()
    {
        return view('manager.project');
    }

    /**
     * @param Request $request
     * @param Project $project
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function process(Request $request, Project $project)
    {
        $project->store($request);
        return redirect('/manager');
    }
}
