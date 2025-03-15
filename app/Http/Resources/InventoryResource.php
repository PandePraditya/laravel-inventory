<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InventoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'room' => [
                'id' => $this->room->id ?? null,
                'name' => $this->room->name ?? "No Room",
            ],
            'user' => [
                'id' => $this->user->id ?? null,
                'full_name' => $this->user->full_name ?? "No User",
            ],
            'image' => [
                'id' => $this->image->id ?? null,
                'url' => $this->image->url ?? "No Image",
            ],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at
        ];
    }
}
