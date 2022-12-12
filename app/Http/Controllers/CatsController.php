<?php

namespace App\Http\Controllers;

use App\Models\Cats;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Contracts\Providers\Auth;

class CatsController extends Controller 
{
	public function __construct() {
		$this->middleware("auth:api");
	}

	public function index(Request $request) {
		$cats= Cats::select("id", "name", "race")->get();
		return OK("", ["cats"=> $cats], 200);
	}

	public function store(Request $request) {
		$validation= Validator::make($request->all(), [
			"name"=> "required",
			"race"=> "required"
		]);

		if ($validation->fails()) {
			return response()->json(["errors"=> parseErrorMessage($validation->errors())], 400);
		}

		$data= $request->only(["name", "race"]);

		Cats::create($data);

		return OK("cats added.");
	}

	public function show($id) {
		try {
			$cat= Cats::findOrFail($id);

		  return OK("", ["cat"=> $cat]);
		} catch (\Throwable $th) {
			return NOT_FOUND("cat is not found.", 404);
		}	
	}

	public function update(Request $request, $id) {
		//
	}

	public function edit($id) {
		try {
			$cat= Cats::withTrashed()->where("id", $id)->restore();

		  return OK("cat is restored.");
		} catch (\Throwable $th) {
			return NOT_FOUND("cat is not found.", 404);
		}	
	}

	public function destroy($id) {
		try {
			$cat= Cats::findOrFail($id)->delete();

		  return OK("cat is deleted");
		} catch (\Throwable $th) {
			return NOT_FOUND("cat is not found.", 404);
		}	
	}
}
