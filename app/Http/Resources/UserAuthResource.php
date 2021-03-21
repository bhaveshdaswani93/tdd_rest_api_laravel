<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserAuthResource extends JsonResource
{
    public $accessToken;

    public function __construct($resource, $accessToken)
    {
        parent::__construct($resource);
        $this->accessToken = $accessToken;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            $this->merge(new UserResource($this)),
            'access_token' => $this->accessToken
        ];
    }
}
