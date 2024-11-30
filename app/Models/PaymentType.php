<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentType extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentTypeFactory> */
    use HasFactory, HasTranslations, SoftDeletes;
    protected $fillable = [
        'name'
    ];
    public array $translatable = ['name'];
    protected $casts = [
        'paymentType' => 'array'
    ];
    public function orders(){
        return $this->hasMany(Order::class);
    }
}
