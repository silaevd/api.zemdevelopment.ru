<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Project;
use Illuminate\Http\JsonResponse;

/**
 * Class ApiController
 * @package App\Http\Controllers
 */
class ApiController extends Controller
{
    /**
     * @param Project $project
     *
     * @return JsonResponse
     */
    public function getProjects(Project $project)
    {
        return new JsonResponse([
            'success' => true,
            'data'    => $project->getList(),
        ]);
    }

    /**
     * @param Contact $contact
     *
     * @return JsonResponse
     */
    public function getContacts(Contact $contact)
    {
        return new JsonResponse([
            'success' => true,
            'data'    => $contact->getContacts(),
        ]);
    }
}
