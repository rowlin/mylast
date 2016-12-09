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
    

    public function like(){
   //check if its our form
        if ( Session::token() !== Input::get( '_token' ) ) {
            return Response::json( array(
                'msg' => 'Unauthorized attempt to create setting'
            ) );
        }

            $data = [
                'ticket_id' => Input::get('ticket_id'),
                'user_id' => Auth::id(),
            ];
            if($data['user_id'] == null) {
                return redirect('register')->with('message', 'Зарегистрируйтесь');
             }
            $liked = Like::where('user_id', $data['user_id'])->where('ticket_id', $data['ticket_id'])->first();
            if($liked){
                Like::where('id',$liked->id)->delete();

                $response = array(
                    'status' => 'success',
                    'msg' => 'Like -1',
                );

                return Response::json( $response );


                //return Redirect::back()->with('message', 'Liked -1');
            }else {
                Like::create($data);
                //return Redirect::back()->with('message', 'Liked +1 ');
                $response = array(
                    'status' => 'success',
                    'msg' => 'Like +1',
                );

                return Response::json($response);
            }
    }

}
