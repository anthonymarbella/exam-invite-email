<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
    protected $redirectTo = '/home';
    protected $username;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->username = 'username';
    }

    public function login(Request $request)
    {
        $input = $request->all();

        // $this->validate($request, [
        //     'user_name' => 'required',
        //     'password' => 'required',
        // ]);

        if(auth()->attempt(array('user_name' => $input['user_name'], 'password' => $input['password'])))
        {
            if (auth()->user()->user_role == 'admin') {
                return redirect()->route('admin.home');
            }else{
                return redirect()->route('home');
            }
        }else{
            return redirect()->route('login')
                ->withErrors(['Username And Password Are Wrong.']);
        }

    }

    public function username()
    {
        return $this->username;
    }
}
