<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $name = json_decode($this->name);
        $description = json_decode($this->description);
        return [
            'id' => $this->id,
            'name_uz' => $name->uz,
            'name_ru' => $name->ru,
            'price' => $this->price,
            'description_uz' => $description->uz,
            'description_ru' => $description->ru,
            'stocks' => StockResource::collection($this->whenLoaded('stocks')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
