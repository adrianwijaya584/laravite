<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
	public function __construct() {
		$this->middleware("auth:api", ["except"=> ["login", "register"]]);
	}

	public function login(Request $request) {
		try {
			$validate= Validator::make($request->all(), [
				"email"=> "required",
				"password"=> "required",
			]);
	
			if ($validate->fails()) {
				return response()->json([
					"errors"=> parseErrorMessage($validate->errors())
				], 400);
			}
			$credentials= $request->only("email", "password");
	
			$token= auth("api")->attempt($credentials);
	
			
			if ($token) {
				$user= auth("api")->user();

				return response()->json([
					"token"=> $token,
					"user"=> [
						"name"=> $user->name
					]
				]);
			}
		} catch (\Throwable $th) {
			return response()->json(['error' => 'oops error'], 500);
		}

	}

	public function register(Request $request) {
		try {
			$validate= Validator::make($request->all(), [
				"name"=> "required",
				"email"=> "required",
				"password"=> "required",
			]);
	
			if ($validate->fails()) {
				return response()->json([
					"errors"=> parseErrorMessage($validate->errors())
				], 400);
			}

			$insert= User::insert([
				"name"=> $request["name"],
				"email"=> $request["email"],
				"password"=> Hash::make($request["password"]),
			]);
	
			return response("teregister", 200);
		} catch (\Throwable $th) {
			error_log($th);
			return response()->json($th, 500);
		}
	}

	public function logout() {
		Auth::logout();

		return response()->json([
			"message"=> "logout"
		], 200);
	}

	public function me() {
		$user= Auth::user();

		return response()->json([
			"user"=> $user
		], 200);
	}

	public function refresh() {
		$token= Auth::refresh();

		return response()->json([
			"token"=> $token
		], 200);
	}

}
