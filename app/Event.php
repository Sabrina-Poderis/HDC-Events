<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model{
    use SoftDeletes;

    protected $table = "events";

    protected $fillable = [
        'title',
        'description',
        'establishment_id',
        'event_date',
        'type'
    ];

    public function establishment(){
        return $this->hasOne('App\Establishment', 'id', 'establishment_id');
    }
}