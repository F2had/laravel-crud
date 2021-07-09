<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class PassportAuthController extends Controller
{

  function register(Request $request)
  {

    $validator =  Validator::make($request->all(), [
      'name' => ['required'],
      'email' => ['required', 'email', 'unique:users,email'],
      'password' => ['required']
    ]);

    if ($validator->fails()) {
      return response()->json(['error' => $validator->errors()], 401);
    }

    $user =  User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => $request->password,
    ]);

    $token = $user->createToken("Token")->accessToken;

    return response()->json(['token' => $token], 200);
  }


  function login(Request $request)
  {
    $data = [
      'email' => $request->email,
      'password' => $request->passowrd
    ];

    if (auth()->attempt($data)) {
      $token = auth()->user()->createToken('Token')->accessToken;
      return response()->json(['token' => $token], 200);
    }
    return response()->json(['error' => 'Unauthorised'], 401);
  }
}
