<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * Class Contact
 * @package App
 */
class Contact extends Model
{
    /**
     * @param Request $request
     *
     * @return bool
     */
    public function store(Request $request): bool
    {
        $contacts = self::find(1);
        if (empty($address)) {
            $contacts = new self();
        }
        $contacts->address = $request->request->get('address');
        $contacts->email = $request->request->get('email');
        $contacts->phone = $request->request->get('phone');

        return $contacts->save();
    }
}
