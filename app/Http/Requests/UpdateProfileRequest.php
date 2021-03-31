<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @bodyParam name string required The Name of the post.
 * @bodyParam email string required The unique email of the user. Example: houston.powlowski@example.net
 * @package App\Http\Requests
 */
class UpdateProfileRequest extends FormRequest
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
//        dd($this->user()->id);
        return [
            'name' => 'required|min:6',
            'email' => ['required','email',Rule::unique('users', 'email')->ignore(\Auth::id())]
        ];
    }

//    public function bodyParameters()
//    {
//        return [
//            'name' => [
//                'description' => 'The Name of the post',
//            ],
//            'email' => [
//                'description' => 'The unique email of the user.',
//                'example' => 'houston.powlowski@example.net',
//            ],
//
//        ];
//    }
}
