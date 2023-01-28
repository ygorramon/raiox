<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Password;
class ForgotPasswordClientController extends Controller
{
    

    use SendsPasswordResetEmails;

    public function showLinkRequestClientForm()
    {
        return view('site.auth.passwords.email');
    }

   

    public function broker()
    {
         return Password::broker('clients');
    }

    
}
