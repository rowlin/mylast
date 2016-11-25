<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{

    //Request $request - если использовать paginate
    public function index()
    {
        $id = Auth::user()->id;
        $tickets = Ticket::where('user_id', $id)->OrderBy('created_at', 'DESC')->get();;
        return view('ticket.index', compact('tickets'));
        //не понятно как использовать paginate
        //->with('i', ($request->input('page', 1) - 1) * 5);;
    }

    public function create(){
        return view('ticket.create');
    }

    public  function store(Request $request){
        $this->validate($request, [
            'name' => 'required| max:100',
            'desc' => 'required ',
            'start'=> 'required',
            'end' => 'required',
            'who_sex'=>'required',
            'who_age' => 'required'
        ]);
        $new_ticket = Ticket::create($request->all());
        return redirect()->route('ticket.index')->with('message','Тикет создан');
    }


    public function edit($id){
        $ticket = Ticket::find($id);
        return view('ticket.edit', compact('ticket') );
    }

     public  function update(Request $request, $id){
        $this->validate($request, [
            'name' => 'required| max:100',
            'desc' => 'required ',
            'start'=> 'required',
            'end' => 'required',
            'who_sex'=>'required',
            'who_age' => 'required'
        ]);

         Ticket::find($id)->update($request->all());
        return redirect()->route('ticket.index')->with('message','Тикет обновлен');
    }


    public function destroy($id){
        Ticket::find($id)->delete();
        return redirect()->route('ticket.index')->with('message','Тикет удален');
    }





}
