<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    protected $fillable= ['permissions','name', 'slug'];
    protected $table = 'roles';


    public function users(){
        return $this->belongsToMany('App\User', 'role_users');
    }

}
