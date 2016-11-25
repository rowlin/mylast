<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use Carbon\Carbon;

class HomeController extends Controller
{


    /**
     * Главная страница
     * выводим все тикеты активные сегодня
     */
    public function current_value(){
        return Carbon::now()->format('d/m/Y H:s:i');
    }


    public function today_value(){
        return  Carbon::today()->format('d/m/Y H:s:i');
    }

    public function tomorrow_value(){
        return Carbon::tomorrow()->format('d/m/Y H:s:i');
    }


    public function parse($value){
        return Carbon::parse(str_replace(array("\"", "[", "]"), "", $value))->format('d/m/Y H:s:i');
    }

    public function start(){
        $t = Ticket::where('public', '1')->get();;
        foreach ($t as $ticket){
            $start= $this->parse($ticket->start);
            $end = $this->parse($ticket->end);
            if($start > $this->current_value() and $start< $this->tomorrow_value() ) $tickets[] = $ticket;
        }

        return view('index', compact('tickets'));
    }

    public function today(){

        $tickets = Ticket::where('public', '1')->get();
        //where('start','==', $today)->orWhere('end','==',$today)->get();
      return view('index', compact('tickets'));
    }

    public function tomorrow(){
        $tomorrow = Carbon::tomorrow();
        $tickets = Ticket::where('end','>=', $tomorrow)->get();
    return view('index', compact('tickets'));
    }

    public function later(){
        $later = Carbon::tomorrow();
        $tickets = Ticket::where('start','>=', $later)->get();
        return view('index', compact('tickets'));
    }


    
    public function index()
    {
        return view('home');
    }
    
    
    
}
