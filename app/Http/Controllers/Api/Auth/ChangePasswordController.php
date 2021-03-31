<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * @group Users
 *
 * Users related endpoints
 *
 * @package App\Http\Controllers\Api\Auth
 */
class ChangePasswordController extends Controller
{
    /**
     * @var UserServiceInterface
     */
    private $userService;

    /**
     * ChangePasswordController constructor.
     * @param UserServiceInterface $userService
     */
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }


    /**
     *  Change Password Api
     *
     *  This endpoints allow you to update your password
     *
     * @response
     * {
     * "result": true,
     * "message": "Password updated successfully.",
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
     * @param ChangePasswordRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(ChangePasswordRequest $request)
    {
        // $attributes = $request->validated()
        // auth()->user()->update([
        //     'password' => Hash::make($request->password)
        // ]);

        $this->userService->changePassword(auth()->user(), $request->password);

        return $this->respondWithMessage("Password updated successfully.");
    }
}
