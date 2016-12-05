<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use App\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LikeController extends Controller
{

    /*
     * Принимает id_ticket и id_user
     */
    

    public function like(Request $like){

        if(Auth::check()){
            $data = [
                'ticket_id' => $like->ticket_id,
                'user_id' => Auth::id(),
            ];
            
            $liked = Like::where('user_id', $data['user_id'])->where('ticket_id', $data['ticket_id'])->first();
            if($liked){
                Like::where('id',$liked->id)->delete();
                return Redirect::back()->with('message', 'Liked -1');
            }else Like::create($data);
            return Redirect::back()->with('message', 'Liked +1 ');
        }
        else
            return Redirect::back()->withErrors(['message', 'Вы не авторизованы.']);
    }
}
