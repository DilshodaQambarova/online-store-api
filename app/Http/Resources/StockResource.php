<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StockResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $attributes = json_decode($this->attributes, true);
        return [
            'id' => $this->id,
            'attributes' => [

                [
                    'attribute_id' => $attributes[0]['attribute_id'],
                    'value_id' => $attributes[0]['value_id'],
                ],
                [
                    'attribute_id' => $attributes[1]['attribute_id'],
                    'value_id' => $attributes[1]['value_id'],
                ],
            ],

            'quantity' => $this->quantity
        ];
    }
}
