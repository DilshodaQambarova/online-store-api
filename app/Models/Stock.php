<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    /** @use HasFactory<\Database\Factories\StrockFactory> */
    use HasFactory;
    protected $fillable = [
        'product_id',
        'attributes',
        'quantity'
    ];
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
