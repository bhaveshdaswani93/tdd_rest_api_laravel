<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Resources\UserAuthResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\Contracts\AuthServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * @group Authentication Endpoints
 *
 * APIs for Register,Login,Logout users
 *
 * @package App\Http\Controllers\Api\Auth
 */
class RegisterController extends Controller
{
    /**
     * @var AuthServiceInterface
     */
    private $authService;

    /**
     * RegisterController constructor.
     * @param AuthServiceInterface $authService
     */
    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Register Api
     *
     * This endpoint allow you to register user.
     *
     * @unauthenticated
     *
     * @responseField auth_token string The Bearer token which should be included in header for auth required endpoint
     *
     * @response {
     * "result": true,
     * "message": "",
     * "payload": {
     * "user_id": 2,
     * "name": "Lorem",
     * "email": "ipsum+1@gmail.com",
     * "auth_token": "<auth token>"
     * },
     * "errors": null
     * }
     * @response status=422 scenario="Email already registered"
     *{
     * "result": false,
     * "message": "Validation Error",
     * "payload": null,
     * "errors": {
     * "email": [
     * "The email has already been taken."
     * ]
     * }
     * }
     * @param RegisterUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(RegisterUserRequest $request)
    {
        // $user = User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password)
        // ]);

        $user = $this->authService->register($request->validated());

        $accessToken = $user->createToken('Auth Token')->accessToken;

        return $this->respondWithData(new UserAuthResource($user, $accessToken));
        // return response()->json(['data' =>]);
    }
}
