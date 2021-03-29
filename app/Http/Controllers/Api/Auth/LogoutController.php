<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    /**
     * Logout the user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        Auth::user()->token()->revoke();
        // Auth::user()->tokens()->first()->revoke();
        // $request->user()->tokens->each(function ($token, $key) {
        //     $token->delete();
        // });
        // dd($token);
        // $token->revoke();
        // Auth::guard('api')->logout();
        return $this->respondWithMessage("User logout successfully.");
    }
}
