<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Ticket;
use Session;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{

    public function setcity(Request $request){
     if (Auth::check()){
        $user= User::findOrFail(Auth::id());
         $user->sity = $request->city;
         $user->save();
         Session::put('city', $request->city);
     }else
        Session::put('city', $request->city);
    }


    public function update(Request $request){
        $id = Auth::id();
        $this->validate($request, [
        'name' => 'required',
        'age'  =>  'required',
        'sex'  =>  'required',
        'sity' => 'required',
        'phone' => 'required',
        ]);
        $input = $request->all();
        $user = User::findorfail($id);
        $updateNow  = $user->update($input);
        $message ='Информация изменена';
        return redirect('profile');
    }

    public function edit(){
      $user = User::findOrFail(Auth::id());
         // ::where('id', Auth::id())->first();
      return view('user.edit', compact('user'));
    }

    public function profile(){
        $user = User::where('id', Auth::id())->first();
        return view('user.index', compact('user'));
    }

    public function checkUserTicket($data){
        //проверим не пустые ди поля
        $this->validate($data, [
            'user_id' => 'user_id',
            'ticket_id' => 'required',
        ]);

   //->where('user_id',$data['user_id'])->where('ticket_id', $data['ticket_id'])->
    }

    public function UserCount($id){
       $ticket = Ticket::where('id', $id)->first();
       $count = count($ticket->users);
       return $count;
    }
    
    /*
     * ticket_id
     */
    public function adduser(Request $request)
    {
         if (Auth::check()) {
             $data = [
                 'user_id' => Auth::id(),
                 'ticket_id' => $request->ticket_id,
             ];
             //проверить записан ли пользоватиель на данное событие
             $user = User::where('id', $data['user_id'])->first();
             $msg = "";
             $My_count = 0;
             foreach ($user->tickets as $ticket) {
                 if ($ticket->pivot->ticket_id == $data['ticket_id']) {
                     $user->tickets()->detach($data['ticket_id']);
                     $msg = "Вы отписались";
                     break;
                 }
                 $My_count++;
             }
             if ($My_count == count($user->tickets)) {
                 $user->tickets()->attach($data['ticket_id']);
                 $msg = "Вы записались";
             }

             $count = $this->UserCount($data['ticket_id']);
             return response()->json(array('msg' => $msg, 'count' => $count)  ,200);

         }
        else {
            $msg = "Зарегайся или войди, а потом вписывайся)";
            return response()->json(array('msg' => $msg), 200);
        }
    }
}
