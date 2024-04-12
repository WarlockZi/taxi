<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class UserController extends Controller
{

	public function index()
	{
		return response(User::select('id', 'name', 'role', 'email')->get());
	}

	public function update(Request $request, $id)
	{
		$user = User::find($id);
		$user->update($request->all());
	}

	public function destroy($id)
	{
		$user = User::find($id);
		$user->delete();
	}
}
