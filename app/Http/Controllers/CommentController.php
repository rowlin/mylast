<?php

namespace App\Http\Controllers;
use App\Comment;
use Symfony\Component\Console\Input;
use App\Ticket;
use Illuminate\Validation\Validator;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    /*
     * ticket_id
     */

    public function index($id){
        $ticket= Ticket::where('id', $id)->first();
        $allcomments = $ticket->comments()->get();
        return view('comment/index', compact('allcomments','ticket'));
    }

    public function create(Request $request){

        $rules = array(
            'ticket_id'=>'required',
            'parent_id'=>'required',
            'user_id' => 'required',
            'comment' => 'required'
        );
       // $validator = Validator::make ( Input::all (), $rules );
       // if ($validator->fails())
       //    return Response::json(array('errors' => $validator->getMessageBag()->toArray()));




            $comment = new Comment();
            $comment->ticket_id = $request->ticket_id;
            $comment->user_id = $request->user_id;
            $comment->parent_id = $request->parent_id;
            $comment->comment = $request->comment;
            $comment->save();
            return response()->json($comment);





    }

    public function add_comment(Request $request){

    }
    
    
}
