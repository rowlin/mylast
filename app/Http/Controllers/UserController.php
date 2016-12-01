<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{

public function checkUserTicket($data){
//проверим не пустые ди поля
    $this->validate($data, [
        'user_id' => 'required',
        'ticket_id' => 'required',
    ]);

   //->where('user_id',$data['user_id'])->where('ticket_id', $data['ticket_id'])->
}


    /*
     * ticket_id
     */

    public function adduser(Request $request)
    {
        $data = [
            'user_id' => Auth::id(),
            'ticket_id' => $request->ticket_id,
        ];
        //проверить записан ли пользоватиель на данное событие
        $user = User::where('id', $data['user_id'])->first();
        $message = "";
        if(count($user->tickets)==0){
            $user->tickets()->attach($data['ticket_id']);
            $message= "Вы подписались";
        }else {
            foreach ($user->tickets as $ticket) {
                if ($ticket->pivot->ticket_id == $data['ticket_id']) {
                    $user->tickets()->detach($data['ticket_id']);
                    $message = "Вы отписались";
                    break;
                }

                $user->tickets()->attach($data['ticket_id']);
                $message = "Вы подписались";
            }
        }
        return Redirect::back()->with('message', $message);

    }
}
