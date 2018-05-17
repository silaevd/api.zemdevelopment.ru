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
     * @param Project $project
     *
     * @return Factory|\Illuminate\View\View
     */
    public function index(Project $project)
    {
        $projectList = $project->getList();
        return view('manager.index', ['projectList' => $projectList]);
    }

    /**
     * @return Factory|\Illuminate\View\View
     */
    public function project()
    {
        return view('manager.project');
    }

    /**
     * @param Project $project
     * @param int $id
     * @return Factory|\Illuminate\View\View
     */
    public function edit(Project $project, int $id)
    {
        $project = $project->getById($id);
        return view('manager.project', ['project' => $project]);
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
