<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class DeliveryMethod extends Model
{
    /** @use HasFactory<\Database\Factories\DeliveryMethodFactory> */
    use HasFactory, HasTranslations;
    protected $fillable = [
        'name',
        'estimated_time',
        'price'
    ];
    public array $translatable = [
        'name',
        'estimated_time'
    ];
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
