<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(ChangePasswordRequest $request)
    {
        // $attributes = $request->validated()
        auth()->user()->update([
            'password' => Hash::make($request->password)
        ]);

        return $this->respondWithMessage("Password updated successfully.");
    }
}
