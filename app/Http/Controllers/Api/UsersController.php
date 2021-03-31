<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Http\Request;

/**
 * @group Users
 *
 * Users related endpoints
 */
class UsersController extends Controller
{
    /**
     * @var UserServiceInterface
     */
    private $userService;

    /**
     * UsersController constructor.
     * @param UserServiceInterface $userService
     */
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Update User Api
     *
     * This Endpoint allow user to update their profile
     *
     * @response status=200 {
     * "result": true,
     * "message": "User profile updated successfully.",
     * "payload": null,
     * "errors": null
     * }
     *
     * @response status=401 scenario="Unauthenticated"
     * {
     * "result": false,
     * "message": "Given authorization token is invalid, please login again",
     * "payload": null,
     * "errors": null
     * }
     *
     * @param UpdateProfileRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateProfileRequest $request)
    {
        // $request->validate([]);
        // auth()->user()->update($request->validated());

        $this->userService->update(auth()->user(), $request->validated());

        return $this->respondWithMessage('User profile updated successfully.');
    }
}
