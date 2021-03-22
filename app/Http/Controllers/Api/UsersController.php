<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function update(UpdateProfileRequest $request)
    {
        // $request->validate([]);
        auth()->user()->update($request->validated());
        return $this->respondWithMessage('User profile updated successfully.');
    }
}
