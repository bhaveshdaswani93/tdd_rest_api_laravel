<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @group Authentication Endpoints
 * @package App\Http\Controllers\Api\Auth
 */
class LogoutController extends Controller
{
    /**
     * Logout the user
     *
     * This endpoints allow user to logout
     *
     * @response
     * {
     * "result": true,
     * "message": "User logout successfully.",
     * "payload": null,
     * "errors": null
     * }
     * @response status=401 scenario="Unauthenticated"
     * {
     * "result": false,
     * "message": "Given authorization token is invalid, please login again",
     * "payload": null,
     * "errors": null
     * }
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
