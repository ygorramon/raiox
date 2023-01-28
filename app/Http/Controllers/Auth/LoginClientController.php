<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\Models\Client;
use Carbon\Carbon;

class LoginClientController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest:clients')->except('logout');
    }

    public function showClientLoginForm()
    {
        return view('site.auth.login');
    }

    public function clientLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

if(isset(Client::where('email',$request->email)->first()->expireAt)){
if(Client::where('email',$request->email)->first()->expireAt>=date_format(now(),'Y-m-d')){
        if (Auth::guard('clients')
        ->attempt(['email' => $request->email, 'password' => $request->password,
         'active' => 1
        ], 
                $request->get('remember'))) {


            return redirect()->intended('/Desafios');
        }
        return back()
        ->withInput($request->only('email', 'remember'))
        ->with('message','Usuário ou Senha incorretos');
    }}
        return back()
        ->withInput($request->only('email', 'remember'))
        ->with('message','Usuário Expirado');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return $this->loggedOut($request) ?: redirect('/login');
    }
}
