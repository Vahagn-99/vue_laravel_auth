<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserRegistrationRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, mixed>
   */
  public function rules()
  {
    return [
      'name' => ['required', 'string'],
      'email' => ['required', 'email', 'string', 'unique:users,email'],
      'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()]
    ];
  }

  /* request password make to hashed */
  public function toPasswordHsh($password)
  {
    $password = Hash::make($password);
    return $password;
  }
}
