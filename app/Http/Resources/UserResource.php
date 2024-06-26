<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin User
 */
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->getKey(),
            'name' => $this->name,
            'lastname' => $this->lastname,
            'full_name' => $this->name . ' ' . $this->lastname,
            'email' => $this->email,
            'role' => $this->role,
            'registered_at' => $this->created_at
        ];
    }
}
