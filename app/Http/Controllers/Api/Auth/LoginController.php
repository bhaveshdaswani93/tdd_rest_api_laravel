<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Resources\UserAuthResource;
use App\Models\User;
use App\Services\Contracts\AuthServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * @var AuthServiceInterface
     */
    private $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }


    /**
     * @param LoginUserRequest $request
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function __invoke(LoginUserRequest $request)
    {
        $result = $this->authService->login($request->validated());

        if ($result['result'] === false) {
            return $this->respondBadRequest($result['message']);
        }

        $user = $result['user'];

        $accessToken = $user->createToken('Auth Token')->accessToken;

        return $this->respondWithData(new UserAuthResource($user, $accessToken));
    }
}
