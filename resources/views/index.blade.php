@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @if(isset($tickets))
                @foreach($tickets as $ticket)
                    <section>
                        <h2>{{$ticket->name}}</h2>
                        <h4>{{ $ticket->desc }}</h4>
                        {{ $ticket->start}}  -  {{$ticket->end}}


                        <div class="form-inline">
                            <div class="form-group">
                                    <form method="post" action=".like.{id}">
                                    <i class="fa fa-heart" aria-hidden="true" ></i>
                                    </form>
                             </div><!--form-group-->

                        <!--a href="">Поделиться</a-->
                        <!--поделиться - социальные кнопки использовать -->
                        <!--a href="">Напомнить</a-->

                    <div class="form-group">
                        <form method="post" action="commen/{id}">
                            <i class="fa fa-user-plus" aria-hidden="true"></i>
                        </form>
                    </div><!--form-group-->

                            <div class="form-group">
                            <form method="post" action="comment/{id}">
                                <i class="fa fa-commenting-o" aria-hidden="true"></i>
                            </form>
                                </div><!--form-group-->
                            </div>
                    </section>
                @endforeach
                    @else

                    <h2>К сожалению заявок нет, но вы можете <a href="{{ url('ticket/create') }}">создать тикет</a> </h2>

                @endif
            </div>
        </div>
    </div>
@endsection