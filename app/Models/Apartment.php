<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'rooms',
        'beds',
        'bathrooms',
        'square_meters',
        'address',
        'image',
        'longitude',
        'latitude',
        'visibility',
        'slug'
    ];

    public static function generateSlug($title)
    {
        return Str::slug($title, '-');
    }

    public function services()
    {
        return $this->belongsToMany('App\Models\Apartment');
    }
}
