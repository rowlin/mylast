<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected  $fillable= ['comment', 'ticket_id', 'user_id', 'parent_id' ];
    public $table = "comment";
    

    public function Subcomment(){
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function Parent(){
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function tickets(){
        return $this->belongsTo(Comment::class,'ticket_id');
    }

     public function users(){
         return $this->belongsTo(Comment::class, 'user_id');
     }

    public function getUserName(){
        return $this->users()->name;
    }


}
