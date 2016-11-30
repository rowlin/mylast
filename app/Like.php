<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table ="like";
    public $timestamps = false;
    protected $fillable =['ticket_id', 'user_id'];
}
