<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = ['start_date', 'end_date', 'is_active'];
    public function apartments()
    {
        return $this->belongsToMany(Apartment::class);
    }
}
