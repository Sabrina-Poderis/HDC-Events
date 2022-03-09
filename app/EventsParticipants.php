<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventsParticipants extends Model{

    protected $table = "event_participants";

    protected $fillable = [
        'user_id',
        'event_id'
    ];

    public function event(){
        return $this->hasOne('App\Event', 'id', 'event_id');
    }

    public function user(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}