<?php

namespace App\Models\Email;

use App\Models\BaseModel;

class Email extends BaseModel {

    use Attribute,
        Relation,
        Gateway;

    public static $rules = [
        'to_email' => 'required|email|max:255',
        'from_email' => 'required|email|max:255',
        'subject' => 'required|max:255',
    ];

    protected $appends = [
        'status'
    ];
}
