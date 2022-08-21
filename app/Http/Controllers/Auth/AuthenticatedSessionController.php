<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
  /**
   * Handle an incoming authentication request.
   *
   * @param  \App\Http\Requests\Auth\LoginRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(LoginRequest $request)
  {
    $request->authenticate();

    $request->session()->regenerate();

    $user = User::find(auth()->id());

    Auth::login($user, $request->remember);

    $token = $user->createToken('main')->plainTextToken;

    return new UserResource(['user' => $user, 'token' => $token]);
  }

  /**
   * Destroy an authenticated session.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request)
  {
    $user = User::find(auth()->id());

    $user->tokens()->delete();

    Auth::guard('web')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return response()->noContent();
  }
}
