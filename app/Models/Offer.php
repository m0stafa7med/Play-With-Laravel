<?php

namespace App\Models;

use App\Scopes\OfferScope;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table="offers";
    protected $fillable=['photo','name_ar','name_en','price','details_ar','details_en','created_at','updated_at','status'];
    protected $hidden=['created_at','updated_at'];
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new OfferScope);
    }
    public function setNameEnAttribute($value)
    {
        $this->attributes['name_en'] = strtoupper($value);
    }
}
