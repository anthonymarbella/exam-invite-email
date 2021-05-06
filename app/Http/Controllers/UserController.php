<?php

namespace App\Http\Controllers;

use App\Mail\UserVerificationMail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::find($id);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        if(Auth::id() == $id)
        {

            $request->merge([
                'password' => Hash::make($request->password)
            ]);

            if(User::where('id', $id)->update(request()->except(['registered_at','email_verified_at','email','user_role','created_at','updated_at'])))
            {
                return ["return"=>true];
            }

            return ["return"=>false];

        }
        return ["return"=>false,"message"=>"You are trying to update other user."];

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function sendEmailVerificationNotification(Request $request)
    {

        $loggedInUser_id=Auth::user()->id;

        $content = [
            'userId' => $loggedInUser_id,
            'code' => rand (000000,999999)
        ];

        User::where('id', $loggedInUser_id)
        ->update(['two_factor_code' => $content['code']]);

        Mail::to(Auth::user()->email)->send(new UserVerificationMail($content));

        $message='Verification link sent!';
        return (is_null($request->_token)) ? ['return'=>true,'message'=>$message] : view('auth.verify')->with('message', $message);
    }


    public function emailVerificationRequest ($id, $code)
    {
        if (User::where('id', $id)
        ->where('two_factor_code', $code)
        ->update(['email_verified_at' => DB::raw('CURRENT_TIMESTAMP')])  )
        {
            return redirect()->route('home');
        }

        return "Invalid verfication code.";


    }


}
