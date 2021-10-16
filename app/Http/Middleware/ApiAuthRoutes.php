<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiAuthRoutes
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5|max:12'
        ]);

        $User = User::where('email', '=', $request->email)->first();
        if ($User) {
            if (Hash::check($request->password, $User->password)) {
                $request['user_id'] = $User->id;
                return $next($request);
            } else {
                return response()->json(["message" => "incorrect password."], 401);
            }
        } else {
            return response()->json(["message" => "account not found."], 401);
        }
    }
}
