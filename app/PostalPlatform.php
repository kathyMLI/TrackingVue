<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostalPlatform extends Model
{
    protected $fillable = [
        'name'
    ];

    public function trackings()
    {
        return $this->hasMany(Tracking::class);
    }
}
