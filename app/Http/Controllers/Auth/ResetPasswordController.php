<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Validation\Validator as Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
use Symfony\Component\HttpFoundation\Response;

class ResetPasswordController extends Controller
{
    public function showForgetPassword(Request $request)
    {
        return view('cms.auth.forgot-password');
    }

    public function sendResetEmail(Request $request)
    {
        $validator = Validator($request->all(), [
            'email'  => [
                'required', 'email', function ($validator, $value) {
                    if (!DB::table('users')->where('email', $value)->exists() || !DB::table('admins')->where('email', $value)->exists()) {
                        return "The provided $validator is not valid.";
                        // return  $validator;
                    }
                }
            ],

        ]);

        if (!$validator->fails()) {

            $status = Password::sendResetLink($request->only('email'));

            //  const RESET_LINK_SENT = 'passwords.sent';
            // if the we get reset link it will give me a message from password.send lang en folder

            return $status === Password::RESET_LINK_SENT
                ?  response()->json(['message' => __($status)], Response::HTTP_OK)
                : response()->json(['message' => __($status)], Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    public function resetPassword(Request $request, $token)
    {
        // if the varibale in post method get it by input request if get method use it var in prarameter  
        return view('cms.auth.reset-password', [
            'token' => $token,                  
            'email' => $request->input('email'),
        ]);
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator($request->all(), [
            'token' => 'required',
            'email'  => [
                'required', 'email', function ($validator, $value) {
                    if (!DB::table('users')->where('email', $value)->exists() || !DB::table('admins')->where('email', $value)->exists()) {
                        return "The provided $validator is not valid.";
                        // return  $validator;
                    }
                }
            ],
            'password' => 'required|string|min:3|confirmed',
        ]);

        if (!$validator->fails()) {

            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user, $password) {
                    $user->forceFill([
                        'password' => Hash::make($password)
                    ])->setRememberToken(Str::random(60));
                    $user->save();
                    event(new PasswordReset($user));
                }
            );

            return $status === Password::PASSWORD_RESET
                ?  response()->json(['message' => __($status)], Response::HTTP_OK)
                : response()->json(['message' => __($status)], Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }
}
