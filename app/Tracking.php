<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use IsaiasCardenas\CorreosChile\Domcrawler;
use App\Filters\Filterable;

class Tracking extends Model
{
    use Filterable;

    protected $fillable = [
        'code', 'data', 'delivered', 'description', 'history',
    ];

    public static function getByCode($code)
    {
        return Tracking::where('code', '=', $code)->get();
    }

    public static function getData($code)
    {
        $dom = new Domcrawler($code);
        $track = json_decode($dom->getData());
        return [
            "code" => $code,
            "delivered" => $track->delivered,
            "history" => json_encode($track->history),
            "data" => json_encode($track->data)
        ];
    }

    public function getDataAttribute()
    {
        return json_decode($this->attributes["data"]);
    }

    public function getHistoryAttribute()
    {
        return json_decode($this->attributes["history"]);
    }

    public function getDeliveredAttribute()
    {
        return $this->attributes["delivered"] ? "Entregado" :  "En camino";
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('description');
    }
}
