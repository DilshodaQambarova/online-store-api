<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $name = json_decode($this->name);
        return [
            'id' => $this->id,
            'name_uz' => $name->uz,
            'name_ru' => $name->ru,
        ];
    }
}
