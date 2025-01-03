<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory, HasTranslations;

    protected $fillable = [
        'category_id',
        'name',
        'price',
        'description',
    ];
    protected array $translatable = [
        'name',
        'description',
    ];
    protected $casts = [
        'name' => 'array',
        'description' => 'array',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function stocks()
    {
        return $this->hasMany(Stock::class, 'product_id');
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function withStock($stockId)
    {
        $this->stocks = [
            Stock::findOrFail($stockId)
        ];
        return $this;
    }
    public function status(){
        return $this->morphOne(Status::class, 'statusable');
    }
    public function images(){
        return $this->morphMany(Attachment::class, 'attachmentable');
    }
}
