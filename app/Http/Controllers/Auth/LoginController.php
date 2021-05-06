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
                return ($request->return == 'json') ? ["return"=>true,"user_role"=>"admin"] : redirect()->route('admin.home');
            }else{
                return ($request->return == 'json') ? ["return"=>true,"user_role"=>"user"] : redirect()->route('home');
            }
        }else{
            $message = "Username And Password Are Wrong.";
            return ($request->return == 'json') ? ["return"=>false,"message"=>$message] : redirect()->route('login')->withErrors([$message]);
        }

    }

    public function username()
    {
        return $this->username;
    }
}
