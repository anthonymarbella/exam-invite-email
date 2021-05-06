<?php



namespace App\Http\Middleware;



use Closure;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Routing\Route;


class IsVerified

{

    /**

     * Handle an incoming request.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \Closure  $next

     * @return mixed

     */

    public function handle($request, Closure $next)
    {

        if( !is_null(auth()->user()->email_verified_at) ){

            return $next($request);

        }

        $message = "You are not verified.";
        $json = ["return"=>false,"message"=>$message];
        return ($request->return == 'json') ? response(["return"=>false,"message"=>$message]) : redirect()->route('verification.notice');
    }

}
