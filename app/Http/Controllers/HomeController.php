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
        return Carbon::now()->format('d/m/Y');
    }


    public function today_value(){
        return  Carbon::today()->format('d/m/Y');
    }

    public function tomorrow_value(){
        return Carbon::tomorrow()->format('d/m/Y');
    }

    public  function later_value($value = 1){
        if($value) return Carbon::tomorrow()->addDay()->format('d/m/Y');
        else return Carbon::tomorrow()->addDays($value)->format('d/m/Y');
    }


    public function parse($value ){
        return Carbon::parse(str_replace(array("\"", "[", "]"), "", $value))->format('d/m/Y');
    }

    public function start(){
        $t = Ticket::where('public', '1')->get();
        foreach ($t as $ticket){
            $start= $this->parse($ticket->start);
            if($start == $this->current_value()) $tickets[] = $ticket;
        }
        return view('index', compact('tickets'));
    }


    public function tomorrow(){
        $t = Ticket::where('public','1')->get();
        foreach ($t as $ticket){
            $start = $this->parse($ticket->start);
            if($start == $this->tomorrow_value())
                $tickets[] = $ticket;
        }
       // $tickets = Ticket::where('','>', $this->tomorrow_value())->get();
    return view('index', compact('tickets'));
    }

    public function later(){

        $t = Ticket::where('public', 1)->get();
        foreach ($t as $ticket){
            $later = $this->later_value(1);
            $start = $this->parse($ticket->start);
            if($later >= $start )
               $tickets[] = $ticket;
        }
        
        //where('start','>=', $later)->get();
        return view('index', compact('tickets'));
    }

    public function all(){
        $tickets= Ticket::all();
        return view('index', compact('tickets'));
    }


    
    public function index()
    {
        return view('home');
    }
    
    
    
}
