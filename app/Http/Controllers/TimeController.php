<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use Carbon\Carbon;
class TimeController extends Controller
{
    public function today(){
        $t_now = Ticket::where('start',Carbon::now() )->get() ;
        return view('index' , ['tickets' => $t_now]);
    }

    public function tomorrow(){

    }

    public function later(){

    }


}
