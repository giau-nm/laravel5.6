<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\Resource;
use App\Services\UserService;

class Register extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $userService = new UserService();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'job' => $this->job,
            'headline' => $this->headline,
            'company' => $this->company,
            'avatar' => $this->avatar,
            'email' => $this->email,
            'created_at' => (string)$this->created_at,
            'updated_at' => (string)$this->updated_at,
            'connections' => $userService->numberConnection($this->id)
        ];
    }
}
