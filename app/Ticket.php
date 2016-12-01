<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['name', 'city', 'desc','user_id', 'tags', 'start', 'end', 'who_sex','public', 'who_age' ];
    protected $table = 'ticket';

    public function users(){
        return $this->belongsToMany('App\User','pivotUserTicket', 'user_id', 'ticket_id');
    }
}
