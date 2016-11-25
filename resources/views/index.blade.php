@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @foreach($tickets as $ticket)
                    <section>
                        <h2>{{$ticket->name}}</h2>
                        <h4>{{ $ticket->desc }}</h4>
                        {{ $ticket->start}}  -  {{$ticket->end}}

                    </section>
                @endforeach

            </div>
        </div>
    </div>
@endsection