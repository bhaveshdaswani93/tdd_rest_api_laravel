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
