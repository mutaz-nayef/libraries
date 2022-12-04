<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    public function show(Request $request)
    {

        // dd($request->guard);

        $validator = Validator(
            ['guard' => $request->guard],
            ['guard' => 'required|string|in:admin,user']
        );
        // dd($request->guard);
        if (!$validator->fails()) {
            session()->put('guard', $request->guard);
            return response()->view('cms.auth.login');
        } else {
            abort(Response::HTTP_NOT_FOUND);
        }
    }

    public function login(Request $request)
    {
        $value = $request->input('email');
        $validator = Validator($request->all(), [
            // 'email'  => 'required|email|exists:admins,email|exists:users,email',
            'email'  => [
                'required', 'email', function ($validator, $value) {
                    if (!DB::table('users')->where('email', $value)->exists() || !DB::table('admins')->where('email', $value)->exists()) {
                        return "The provided $validator is not valid.";
                    }
                }
            ],
            'password'  => 'required|string|min:3',
            'remember' => 'boolean', // in js you should put boolean,but in form submit you should put it naullable
        ]);
        if (!$validator->fails()) {
            $credentials = [
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ];

            if (Auth::guard(session()->get('guard'))->attempt($credentials, $request->input('remember'))) {
                // session()->regenerate();
                return response()->json(['message' => 'Logged In Successfully'], 200);
            } else {
                return response()->json(['message' => 'Logged In Failed Check Your 
                Credentials'], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }


    public function logout(Request $request)
    {
        $guard = session('guard');        // here you must get the guard session before invalidate it because it flush destroy
        Auth::guard($guard)->logout();
        $request->session()->invalidate();

        return redirect()->route('cms.login', $guard);
    }
}
