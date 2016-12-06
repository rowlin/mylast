<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'sity', 'phone', 'sex', 'vk_url', 'img'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token',];

    public  function getSexAttribute($value){
        if($value == 1) return "Мужской";
        else if($value == 0) return "Жунский";
        else return false;
    }


    public function comments(){
        return $this->hasMany(Comment::class, 'user_id');
    }

    public function tickets(){
        return $this->belongsToMany('App\Ticket','pivotUserTicket')->withPivot( 'user_id', 'ticket_id');
    }

    public function roles(){
         return $this->belongsToMany('App\Role', 'role_users','role_id', 'user_id' );
    }
    
    public function inRole($role) {
        return (bool) $this->roles()->where('name', '=', $role)->count();
    }
    
    public function hasAnyRole($roles){
        if(is_array($roles)){
            foreach ($roles as $role){
                if ($this->hasRole($role)){
                    return true;
                }
            }
        }
        else{
            if($this->hasRole($roles)){
                return true;
            }
        }
        return false;
    }

    public function hasRole($role){
        if($this->roles()->where('name',$role)->first()){
            return true;
        }
        return false;
    }



}
