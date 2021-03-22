<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Resources\UserAuthResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(LoginUserRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return $this->respondBadRequest('User not registered.');
        }

        if (!Hash::check('password', $user->password)) {
            return $this->respondBadRequest('Wrong password provided.');
        }

        $accessToken = $user->createToken('Auth Token')->accessToken;

        return $this->respondWithData(new UserAuthResource($user, $accessToken));
    }
}
