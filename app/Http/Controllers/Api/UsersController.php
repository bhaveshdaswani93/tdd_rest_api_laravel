<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    /**
     * Undocumented variable
     *
     * @var UserServiceInterface
     */
    private $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function update(UpdateProfileRequest $request)
    {
        // $request->validate([]);
        // auth()->user()->update($request->validated());

        $this->userService->update(auth()->user(), $request->validated());

        return $this->respondWithMessage('User profile updated successfully.');
    }
}
