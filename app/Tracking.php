<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use IsaiasCardenas\Domcrawler\Domcrawler;
use App\Filters\Filterable;

class Tracking extends Model
{
    use Filterable;

    protected $fillable = [
        'code', 'data', 'delivered', 'description', 'history',
    ];

    public static function getByCode($code)
    {
        return self::where('code', '=', $code)->get();
    }

    public static function getData($code, $platform)
    {
        $dom = new Domcrawler();
        $track = json_decode($dom->parse($code, $platform));
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

    public function postalPlatform()
    {
        return $this->belongsTo(PostalPlatform::class);
    }
}
