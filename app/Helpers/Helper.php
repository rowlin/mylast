<?php

namespace App\Helpers;
use App\Like;
use App\Ticket;
use App\Comment;
use App\User;
use Auth;
use Illuminate\Support\Facades\Session;
use SypexGeo;
use Illuminate\Cookie;

class Helper {
    static function getLikeCount($id) {
        $like = Like::where('ticket_id' , $id)->count();
        return $like;
    }

    static function getUserCount($id){
       $ticket = Ticket::where('id', $id)->first();
       $count = count($ticket->users);
       return $count;
    }

    static  function getCommentCount($id){
        $comments_count = Comment::where('ticket_id' , $id)->count();
        return $comments_count;
    }

    static function getGeoLoc($val){
        $ip = SypexGeo::get($_SERVER['REMOTE_ADDR']);
        switch ($val){
            case "ru" :
            return $ip['city']['name_ru'];
            case "en" :
            return $ip['city']['name_en'];
        }
    }

    static function getGeoLocation($val){
        if(Auth::check()) {
            $user = User::findOrFail(Auth::id());
            if(!$user->sity) {
                $sity = Helper::getGeoLoc($val);
                return $sity;
            }else {
                $city = $user->sity;
                return $city;
            }
        }
        else{
            $city = Helper::getGeoLoc($val);
        if(!Session::has('city')){
            Session::put('city', $city);
        }else
            $city = Session::get('city');
            return $city;
        }
    }


}