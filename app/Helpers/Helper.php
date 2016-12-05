<?php

namespace App\Helpers;
use App\Like;
use App\Ticket;

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
}