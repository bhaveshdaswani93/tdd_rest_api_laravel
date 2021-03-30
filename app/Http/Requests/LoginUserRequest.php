<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class LoginUserRequest
 *
 * @bodyParam email string required The unique email of the user. Example: houston.powlowski@example.net
 * @bodyParam password string required The password which will be used for login
 * @package App\Http\Requests
 */
class LoginUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => 'required',
            'email' => 'required'
        ];
    }
}
