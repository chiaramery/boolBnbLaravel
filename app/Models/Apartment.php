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
        'user_id',
    ];

    public static function generateSlug($title, $address)
    {
        return Str::slug("$title + $address", '-');
    }

    public function services()
    {
        return $this->belongsToMany('App\Models\Service');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }

    public function promotions()
    {
        return $this->belongsTo(Promotion::class)->withTimestamps()->withPivot(['is_active', 'start_date', 'end_date']);
    }
}
