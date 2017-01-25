<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function updateToken()
    {
        $this->attributes['api_token'] = str_random(60);
        return $this;
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public static function hasTrackingCode($code)
    {
        return User::whereHas("trackings", function ($query) use ($code) {
            return $query->where('code', $code);
        })->get()->isEmpty();
    }

    public function hasCode($code)
    {
        return $this->trackings->where('code', $code)->isEmpty() ? false : true;
    }

    public function trackings()
    {
        return $this->belongsToMany(Tracking::class)
            ->withPivot('description');
    }

    public function subscriptions()
    {
        return $this->belongsTo(Subscription::class);
    }

    public function canAttach($code)
    {
        return ($this->trackings()->get()->count() < $this->subscription()->first()->quantity) && !$this->hasCode($code);
    }
}
