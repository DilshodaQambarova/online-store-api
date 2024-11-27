<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Value extends Model
{
    /** @use HasFactory<\Database\Factories\ValueFactory> */
    use HasFactory, HasTranslations;
    protected $fillable = [
        'attribute_id',
        'name'
    ];

    protected array $translatable = ['name'];

    public function attribute(){
        return $this->belongsTo(Attribute::class);
    }
}
