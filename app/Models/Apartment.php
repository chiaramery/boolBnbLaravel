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
        'slug',
        'user_id'
    ];

    public static function generateSlug($title, $address)
    {
        return Str::slug("$title + $address", '-');
    }

    public function services()
    {
        return $this->belongsToMany('App\Models\Apartment', 'apartment_service', 'apartment_id', 'services_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
