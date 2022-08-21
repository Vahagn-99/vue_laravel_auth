<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegistrationRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
  /**
   * Handle an incoming registration request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   *
   * @throws \Illuminate\Validation\ValidationException
   */
  public function store(UserRegistrationRequest $request)
  {
    $data = $request->validated();
    $data['password'] = $request->toPasswordHsh($data['password']);

    $user = User::create($data);

    $token = $user->createToken('main')->plainTextToken;

    Auth::login($user);
    
    return new UserResource(['user' => $user, 'token' => $token]);
  }
}
