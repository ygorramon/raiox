<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Password;
use Auth;
class ResetPasswordClientController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */
    protected $redirectTo = '/desafios';

    use ResetsPasswords;

    public function showResetForm(Request $request, $token = null)
    {
        return view('site.auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */

    public function broker()
    {
        return Password::broker('clients');
    }

    protected function guard()
    {
        return Auth::guard('clients');
    }
}