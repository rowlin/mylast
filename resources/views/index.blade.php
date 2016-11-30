@extends('layouts.app')

@section('content')

    @if($errors->any())
        <h4>{{$errors->first()}}</h4>
    @endif

@if (\Session::has('msg'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('msg') !!}</li>
        </ul>
    </div>
@endif

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @if(isset($tickets))
                @foreach($tickets as $ticket)
                    <section>

                        <div class="col-md-2">
                            photo
                        </div>

                        <div class="col-md-8">
                        <h2>{{$ticket->name}}</h2>
                        <h4>{{ $ticket->desc }}</h4>
                        {{ $ticket->start}}  -  {{$ticket->end}}
                        </div>

                        <div class="col-md-2">
                        осталось столько то времени



                        <div class="form-inline">
                            <div class="form-group">
                                {!! Form::open(['method' =>'POST', 'route' => 'like']) !!}
                                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                                <button class="fa fa-heart" aria-hidden="true" type="submit" ></button>
                                {!! Form::close() !!}

                             </div><!--form-group-->
                        <!--a href="">Поделиться</a-->
                        <!--поделиться - социальные кнопки использовать -->
                        <!--a href="">Напомнить</a-->

                    <div class="form-group">
                        {!! FOrm::open(['']) !!}}
                        <form method="post" action="commen/{id}">
                            <i class="fa fa-user-plus" aria-hidden="true"></i>
                        </form>
                    </div><!--form-group-->

                            <div class="form-group">
                            <form method="post" action="comment/{id}">
                                <i class="fa fa-commenting-o" aria-hidden="true"></i>
                            </form>
                                </div><!--form-group-->
                            </div><!--form-inline-->
                            </div><!---col-md-2->

                    </section>
                @endforeach
                    @else

                    <h2>К сожалению заявок нет, но вы можете <a href="{{ url('ticket/create') }}">создать тикет</a> </h2>

                @endif
            </div>
        </div>
    </div>
@endsection