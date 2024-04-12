<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{

	public function login(Request $request)
	{
		$data = Validator::make($request->all(), [
			'name' => 'required',
			'password' => 'required',
		]);

		if ($data->fails()) {
			return response()->json([
				'errors' => $data->errors()
			], 422);
		}


		$user = User::where(['name' => $request['name'], 'password' => $request['password']])->firstOrFail();
		if (!$user) {
			return response()->json([
				'message' => 'Invalid login details'
			], 401);
		}

		$token = $user->createToken('auth_token')->plainTextToken;

		return response()->json([
			'access_token' => $token,
			'token_type' => 'Bearer',
		], 200);
	}

	public function logout(Request $request)
	{

		$request->user()->tokens()->delete();

		return response()->json([
			'success' => true,
			'message' => 'You have been successfully logged out!',
		], 200);
	}


}