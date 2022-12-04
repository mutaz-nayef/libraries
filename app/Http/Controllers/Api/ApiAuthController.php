<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use phpseclib3\File\ASN1\Maps\Validity;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthController extends Controller
{
    public function loginPersonal(Request $request)
    {
        $validator = Validator($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:3',
        ]);

        if (!$validator->fails()) {
            $user = User::where('email', $request->input('email'))->first();
            // $user = User::with('city')->where('email', $request->input('email'))->first();
            if (Hash::check($request->password, $user->password)) {

                $token = $user->createToken('User-API');
                $user->setAttribute('token', $token->accessToken);
                // $user->load('city'); // get the use with his city
                return response()->json([
                    'status' => true,
                    'message' => 'Logged in successfully',
                    'object' => $user
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Wrong credentails, check password',
                ], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json([
                'messege' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function loginPGCT(Request $request)
    {
        $validator = Validator($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:3',
        ]);

        if (!$validator->fails()) {
            return $this->generateToken($request);
        } else {
            return response()->json([
                'messege' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    private function generateToken(Request $request)
    {
        try {
            $response = Http::asForm()->post('http://127.0.0.1:8001/oauth/token', [
                'grant_type' => 'password',
                'client_id' => '2',
                'client_secret' => 'tDcZmQFpyPI3KVjEPFSYA2E0rKOrzSO3gkZN5ziK',
                'username' => $request->input('email'),
                'password' => $request->input('password'),
                'scope' => '*',
            ]);
            //   return $response['access_token']; // you should do that because the response type is string , not json object
            $jsonObject =  json_decode($response);
            $user = User::where('email', $request->input('email'))->first();
            $user->setAttribute('token', $jsonObject->access_token);
            return response()->json([
                'status' => true, // always send it as a boolean not 'true' string
                'message' => 'Logged in successfully',
                'data' => $user
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false, // always send it as a boolean not 'true' string
                'message' => $jsonObject->message,
            ]);
        }
    }

    public function changePassword(Request $request)
    {
        $validator = Validator($request->all(), [
            'password' => 'required|string|current_password:user-api',
            'new_password' => 'required|string|min:3|confirmed',
            // 'new_password_confirmation' => 'required|same:new_password',
        ]);
        if (!$validator->fails()) {
            $user = $request->user();
            $user->password = Hash::make($request->input('new_password'));
            $isSave = $user->save();
            return response()->json([
                'status' => $isSave,
                'message' => $isSave ? 'password updated successfully' : 'password update failed!'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'messege' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function forgetPassword(Request $request)
    {
        $validator = Validator($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if (!$validator->fails()) {
            $user = User::where('email', '=', $request->input('email'))->first();
            $randomInt = random_int(1000, 9999);
            $user->verification_code = Hash::make($randomInt);
            $isSave = $user->save();
            return response()->json([
                'status' => $isSave,
                'message' => $isSave ? 'Code sent successfully' : 'Code send failed!',
                'code' => $randomInt
            ]);
        } else {
            return response()->json([
                'messege' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator($request->all(), [
            'email' => 'required|email|exists:users,email', // to know who are you
            'code' => 'required|numeric|digits:4',
            'new_password' => 'required|string|min:3|confirmed',
            // verification_code
        ]);
        if (!$validator->fails()) {
            $user = User::where('email', '=', $request->input('email'))->first();
            if (Hash::check($request->input('code'), $user->verification_code)) {
                $user->password = Hash::make($request->input('new_password'));
                $user->verification_code = null;
                $isSave = $user->save();
                return response()->json([
                    'status' => $isSave,
                    'message' => $isSave ? 'password reset successfully' : 'password reset failed!'
                ], $isSave ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Reset process rejected, check verification code!'
                ], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json([
                'messege' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }


    public function logout(Request $request)
    {
        $revoked = $request->user('user-api')->token()->revoke();
        return response()->json(
            ['message' => $revoked ? 'Logged out successfully' : 'logout failed !'],
            $revoked ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
