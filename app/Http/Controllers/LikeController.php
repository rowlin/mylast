<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Session;
use Response;
class LikeController extends Controller
{

    /*
     * Принимает id_ticket и id_user
     */

    public function LikeCount($id) {
        $like = Like::where('ticket_id' , $id)->count();
        return $like;
    }

    public function CheckLikeCount()
    {
    }

    public function like()
    {
        //check if its our form
        if (Auth::check()) {
            $data = [
                'ticket_id' => Input::get('ticket_id'),
                'user_id' => Auth::id(),
            ];
            $liked = Like::where('user_id', $data['user_id'])->where('ticket_id', $data['ticket_id'])->first();
            if ($liked) {
                Like::where('id', $liked->id)->delete();
                $count = $this->LikeCount($data['ticket_id']);
                $msg = "-1 лайк";
                return response()->json(array('msg' => $msg, 'count' => $count)  ,200);

            } else {
                Like::create($data);
                $count = $this->LikeCount($data['ticket_id']);
                $msg = "Cпасибо за лайк";
                return response()->json(array('msg' => $msg, 'count' => $count), 200);
            }
        }
        else {
            $msg = "Зарегайся, а потом лайкай)";
            return response()->json(array('msg' => $msg), 200);
        }
    }

}
