<?php



namespace App\Http\Middleware;



use Closure;
use Symfony\Component\HttpFoundation\Response;



class IsAdmin

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

        if(auth()->user()->user_role == 'admin'){

            return $next($request);

        }

        $message = "You are not an Admin.";
        $json = ["return"=>false,"message"=>$message];
        return ($request->return == 'json') ? response(["return"=>false,"message"=>$message]) : redirect('home')->with('error',$message);
    }

}
