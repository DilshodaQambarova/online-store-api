<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    /** @use HasFactory<\Database\Factories\UserAddressFactory> */
    use HasFactory;
    protected $fillable = [
        'user_id',
        'latitude',
        'longitude',
        'region',
        'district',
        'street',
        'home',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
