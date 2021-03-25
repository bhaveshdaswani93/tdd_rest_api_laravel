<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $post = Post::find($this->route('post'));
        return $post && $this->user()->can('update', $post);
        // return false;
        // return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'description' => 'required'
        ];
    }

    protected function failedAuthorization()
    {
        throw new AuthorizationException('You are not authorized to perform this action.');
    }
}
