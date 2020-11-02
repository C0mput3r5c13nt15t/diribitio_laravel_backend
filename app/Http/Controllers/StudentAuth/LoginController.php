<?php

namespace App\Http\Controllers\StudentAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Log in with the given credentials and return if correct a jwt associating the student.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $creds = $request->only(['email', 'password']);

        if (!$token = auth()->guard('students')->attempt($creds)) {
            http_response_code(401);
            return response()->json('E-Mail und Passwort stimmen nicht überein.', 401);
        }

        $user = auth('students')->user();

        return response()->json(['token' => $token, 'user_name' => $user->user_name]);
    }
}
