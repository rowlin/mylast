<?php

namespace App\Helpers;
use App\Like;
use App\Ticket;
use App\Comment;
use App\User;
use Auth;
use SypexGeo;

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
            if ($user->county == 0 and $user->sity == 0) {
                $city = Helper::getGeoLoc($val);
                return $city;
            }else
                return $user->country;
        }else{
            $city = Helper::getGeoLoc($val);
            return $city;
        }
    }


}