<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Project;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

/**
 * Class ManagerController
 * @package App\Http\Controllers
 */
class ManagerController extends Controller
{
    /**
     * ManagerController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param Project $project
     * @param Contact $contact
     *
     * @return Factory|\Illuminate\View\View
     */
    public function index(Project $project, Contact $contact)
    {
        $projectList = $project->getList();
        $contacts = $contact->getContacts();

        return view('manager.index', ['projectList' => $projectList, 'contacts' => $contacts]);
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
     *
     * @return RedirectResponse|Redirector
     */
    public function process(Request $request, Project $project)
    {
        $project->store($request);
        return redirect('/manager');
    }

    /**
     * @param Project $project
     * @param int     $id
     *
     * @return RedirectResponse|Redirector
     */
    public function disable(Project $project, int $id)
    {
        $project->disableProject($id);
        return redirect('/manager');
    }

    /**
     * @param Project $project
     * @param int     $id
     *
     * @return RedirectResponse|Redirector
     */
    public function coverRemove(Project $project, int $id)
    {
        $project->coverRemove($id);
        return redirect('/manager/project/'. $id .'/edit');
    }

    /**
     * @param Project $project
     * @param int     $id
     *
     * @return RedirectResponse|Redirector
     */
    public function enable(Project $project, int $id)
    {
        $project->enableProject($id);
        return redirect('/manager');
    }

    /**
     * @param Project $project
     * @param int     $id
     * @param string  $image
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function removeImage(Project $project, int $id, string $image)
    {
        return new JsonResponse(['isDeleted' => $project->removeImage($id, $image)]);
    }
}
