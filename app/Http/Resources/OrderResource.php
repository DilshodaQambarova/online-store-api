<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $address = json_decode($this->address);
        return [
            'id' => $this->id,
            'comment' => $this->comment,
            'sum' => $this->sum,
            'address' => new AddressResource($address),
            'user' => new UserResource($this->whenLoaded('user')),
            'delivery_method' => new DeliveryMethodResource($this->whenLoaded('deliveryMethod')),
            'payment_type' => new PaymentTypeResource($this->whenLoaded('paymentType'))
        ];
    }
}
