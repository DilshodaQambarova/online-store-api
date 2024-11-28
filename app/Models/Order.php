<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;
    protected $fillable = [
        'user_id',
        'payment_type_id',
        'delivery_method_id',
        'sum',
        'comment',
        'products',
        'address',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function deliveryMethod(){
        return $this->belongsTo(DeliveryMethod::class);
    }
    public function paymentType(){
        return $this->belongsTo(PaymentType::class);
    }
}
