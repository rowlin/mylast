@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1 style="text-align: center">Тикеты пользователя</h1><span><a href="{{url('ticket/create')}}">Создать тикет</a> </span>

                @foreach($tickets as $ticket)
                    <section>
                        <h2>{{$ticket->name}}</h2>
                        <h4>{{ $ticket->desc }}</h4>
                        {{ $ticket->start}}  -  {{$ticket->end}}
                        <div class="box" style="float: right">
                        <a class="btn btn-info" href="{{ route('ticket.show',$ticket->id) }}">Показать</a>
                        <a class="btn btn-primary" href="{{ route('ticket.edit',$ticket->id) }}">Редактировать</a>
                        {!! Form::open(['method' => 'DELETE','route' => ['ticket.destroy', $ticket->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Удалить', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}

                        </div>
                    </section>
                @endforeach

            </div>
        </div>
    </div>
    <!-- $ticket->render()  -->
@endsection