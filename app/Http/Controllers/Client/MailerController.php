<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Email\Email;
use App\Models\Users\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class MailerController extends Controller
{
    protected $objEmail;

    public function __construct(Email $objEmail)
    {
        $this->objEmail = $objEmail;
    }

    public function index(Request $objRequest)
    {
        $arrObjEmails = Email::fetchPaginatedEmails($objRequest);

        if($objRequest->ajax()){
            return $arrObjEmails->toJson();
        } else {
            return view('clients.mailer.index')
                ->with('jsonEmails', $arrObjEmails->toJson());
        }
    }

    public function show($intId)
    {
        $objEmail = $this->objEmail->find($intId);

        return view('clients.mailer.show')
            ->with('objEmail', $objEmail);
    }
}
