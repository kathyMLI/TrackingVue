<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'name',
        'quantity',
        'id',
    ];
    
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
