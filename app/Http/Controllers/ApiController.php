<?php

namespace App\Http\Controllers;

use App\Contact;
use App\HomeSlider;
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
    public function getProjects(Project $project): JsonResponse
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
    public function getContacts(Contact $contact): JsonResponse
    {
        return new JsonResponse([
            'success' => true,
            'data'    => $contact->getContacts(),
        ]);
    }

    /**
     * @param HomeSlider $homeSlider
     * @return JsonResponse
     */
    public function getSliders(HomeSlider $homeSlider): JsonResponse
    {
        return new JsonResponse([
            'success' => true,
            'data' => $homeSlider->getList(),
        ]);
    }
}
