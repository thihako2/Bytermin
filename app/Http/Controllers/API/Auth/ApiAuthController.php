<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ApiAuthController extends Controller
{
    //
    public function login(Request $request)
    {
        Log::debug("hereeeeeeee");
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $user = Auth::user();
            $tokenresult = $user->createToken('Token Name');
            $token = $tokenresult->accessToken;
            return response()->json(['status' => 'success', 'access_token' => $token, 'user' => $user], 200);
        } else {
            return response()->json(['status' => 'fail'], 401);
        }
    }
}
