<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    //
    protected $fillable = [
        'name',
        'intro',
        'img_url',
        'location',
        'time_rec',
        'type'
    ];
    public function users()
    {
        return $this->belongsToMany('App\User','user_collection');
    }
}
