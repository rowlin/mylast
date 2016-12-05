<?php

namespace App\Http\Controllers;
use App\Comment;
use App\Ticket;
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
        $this->validate( $request, [
            'ticket_id' => 'required',
            'user_id' => 'user_id',
            'comment'=> 'required',
            'parent_id' => 'required'
                ]);

        Comment::create($request->all());
        return redirect()->back()->with('message','Коммент создвн');
       
    }

    public function add_comment(Request $request){
        
    }
    
    
}
