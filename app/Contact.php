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
    const CONTACT_ID = 1;

    /**
     * @param Request $request
     *
     * @return bool
     */
    public function store(Request $request): bool
    {
        $contacts = self::find(self::CONTACT_ID);
        if (empty($contacts)) {
            $contacts = new self();
        }
        $contacts->address = $request->request->get('address');
        $contacts->email = $request->request->get('email');
        $contacts->phone = $request->request->get('phone');

        return $contacts->save();
    }

    /**
     * @return array|null
     */
    public function getContacts(): ?array
    {
        $contacts = self::find(self::CONTACT_ID);
        if (empty($contacts)) {
            return null;
        }
        return $contacts->toArray();
    }


}
