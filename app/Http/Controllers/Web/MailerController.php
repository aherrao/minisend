<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MailerController extends Controller
{
    public function index(Request $objRequest)
    {
        return Inertia::render('Mailer');
        return view('web.mailer.index');
    }
}
