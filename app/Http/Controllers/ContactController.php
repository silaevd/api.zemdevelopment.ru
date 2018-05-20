<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class ContactController
 * @package App\Http\Controllers
 */
class ContactController extends Controller
{
    /**
     * ContactController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param Request $request
     * @param Contact $contact
     *
     * @return JsonResponse
     */
    public function save(Request $request, Contact $contact)
    {
        $contact->store($request);
        return redirect('manager');
    }
}
