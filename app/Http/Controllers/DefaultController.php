<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    public function index()
    {
        return new JsonResponse(['angular is coming']);
    }
}
