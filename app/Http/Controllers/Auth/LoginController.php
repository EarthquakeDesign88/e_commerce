<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    
    protected function redirectTo(){
        if(Auth()->user()->role == 'admin') {
            return route('adminDashboard');
        }
        elseif(Auth()->user()->role == 'customer') {
            return route('userDashboard');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){
        $input = $request->all();
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|max:30',
        ],
        [
            'email.exists' => 'This email is not exists in database.'
        ]);

        $credentials = array('email'=>$input['email'], 'password'=>$input['password']);
        if(Auth()->attempt($credentials)){
            if(Auth()->user()->role == 'customer'){
                return redirect()->route('showHomepage')->with('success', 'You are now Login successfully.');
            }
            elseif(Auth()->user()->role == 'admin'){
                return redirect()->route('adminDashboard')->with('success', 'You are Login successfully.');
            }
        }else{
            return redirect()->route('login')->with('error', 'Incorrect credentials.');
        }
    }
}
