<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BicycleAccessory extends Model
{
    use SoftDeletes;
    //
    //
    protected $table = 'bicycle_accessories';

    protected $fillable = [
        'sku', 'description', 'category_id','country_id','producer_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class,'country_id');
    }

    public function producer()
    {
        return $this->belongsTo(Producer::class,'producer_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class,'accessory_id');
    }

    public function pdfs()
    {
        return $this->hasMany(Pdf::class,'accessory_id');
    }
}
