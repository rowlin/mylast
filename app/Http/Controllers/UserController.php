<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{

    public function update(Request $request){
        $user = User::findOrFail(Auth::id());

        $this->validate($request, [
        'name' => 'required',
        'age'  =>  'required',
        'sex'  =>  'required',
        'sity' => 'required',
        'phone' => 'required',
        ]);
        $input = $request->all();
        $user->fill($input)->save();
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

    /*
     * ticket_id
     */
    public function adduser(Request $request)
    {
        $data = [
            'user_id' => Auth::id(),
            'ticket_id' => $request->ticket_id,
        ];
         if($data['user_id'] == null) {
             return redirect('register')->with('message', 'Зарегистрируйтесь');
         }
        //проверить записан ли пользоватиель на данное событие
        $user = User::where('id', $data['user_id'])->first();
        $message = "";
        $My_count = 0;
            foreach ($user->tickets as $ticket) {
                if ($ticket->pivot->ticket_id == $data['ticket_id']) {
                    $user->tickets()->detach($data['ticket_id']);
                    $message = "Вы отписались";
                    break;
                }
            $My_count++;
            }
        if($My_count == count($user->tickets)){
            $user->tickets()->attach($data['ticket_id']);
            $message = "Вы записались";
        }

        return Redirect::back()->with('message', $message);

    }
}
