<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class ManagerController
 * @package App\Http\Controllers
 */
class ManagerController extends Controller
{
    /**
     * @return Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('manager.index');
    }

    public function form()
    {
        return view('manager.form');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function process(Request $request)
    {
        return JsonResponse::create($request);
    }
}
