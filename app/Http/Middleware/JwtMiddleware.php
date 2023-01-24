<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Exception;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Http\Middleware\BaseMiddleware;
use Spatie\Permission\Models\Role;

class JwtMiddleware
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
	 * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
	 */
	public function handle(Request $request, Closure $next)
	{
		try {
			$user= JwtAuth::parseToken()->authenticate();

			$role= User::find($user->id)->getRoleNames()[0];
			
			if ($role!="admin") {
				return response()->json(['status' => "role.", "success"=> false], 401);
			}

		} catch(Exception $e) {
			if ($e instanceof TokenInvalidException){
				return response()->json(['status' => 'Token is Invalid', "success"=> false], 401);
			}else if ($e instanceof TokenExpiredException){
					return response()->json(['status' => 'Token is Expired', "success"=> false], 401);
			}else{
					return response()->json(['status' => 'Authorization Token not found', "success"=> false], 401);
			}
		}
		return $next($request);
	}
}
