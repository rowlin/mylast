@extends('layouts.app')

@section('style')
<style type='text/css'>
    .clockdiv{
        color: #000;
        display: inline-block;
        font-weight: 100;
        text-align: center;
        font-size: 30px;
        background: whitesmoke;
    }

    .clockdiv > div{
        padding: 2px;
        border-radius: 3px;
        display: inline-block;
    }

    .clockdiv div > span{
        padding: 7px;
        border-radius: 3px;
        background: lightgrey;
        display: inline-block;
    }

    .smalltext{
        padding-top: 5px;
        font-size: 16px;
    }



</style>

@endsection





@section('content')
    <script type="text/javascript">
        function getTimeRemaining(endtime) {
            var t = Date.parse(endtime) - Date.parse(new Date());
            var minutes = Math.floor((t / 1000 / 60) % 60);
            var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
            var days = Math.floor(t / (1000 * 60 * 60 * 24));
            return {
                'total': t,
                'days': days,
                'hours': hours,
                'minutes': minutes
            };
        }

        function initializeClock(id, endtime) {
            var clock = document.getElementById(id);
            var daysSpan = clock.querySelector('.days');
            var hoursSpan = clock.querySelector('.hours');
            var minutesSpan = clock.querySelector('.minutes');

            function updateClock() {
                var t = getTimeRemaining(endtime);

                daysSpan.innerHTML = t.days;
                hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
                minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);


                if (t.total <= 0) {
                    clearInterval(timeinterval);
                }
            }

            updateClock();
            var timeinterval = setInterval(updateClock, 1000);
        }
    </script>

    <div class="container">

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @if(isset($tickets))
                @foreach($tickets as $ticket)

                    <div class="row" >
                        <section>
                        <div class="col-md-9">
                        <h2>{{$ticket->name}}</h2>
                        <h4>{{ $ticket->desc }}</h4>
                        {{ $ticket->start}}  -  {{$ticket->end}}
                        </div>

                        <div class="col-md-3">
                            <div class="clockdiv" id="clockdiv{{ $ticket->id }}">
                                <div>
                                    <span class="days"></span>
                                    <div class="smalltext">Дней</div>
                                </div>
                                <div>
                                    <span class="hours"></span>
                                    <div class="smalltext">Часов</div>
                                </div>
                                <div>
                                    <span class="minutes"></span>
                                    <div class="smalltext">Минут</div>
                                </div>
                            </div>
                        <div class="form-inline">
                            <div class="form-group" style="padding:3px;">
                                <div class="form-group">
                                    {!! Form::open(['method' =>'POST', 'route' => 'like']) !!}
                                    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                                    <button class="fa fa-heart" aria-hidden="true" type="submit" ></button>
                                    {!! Form::close() !!}
                                </div><!--form-group-->
                            <div class="form-group">
                                {!! Helper::getLikeCount($ticket->id) !!}
                            </div>
                        </div>

                            <div class="form-group" style="padding:3px;">

                            <div class="form-group">
                        {!! Form::open(['method' =>'POST', 'route' => 'add_user']) !!}
                        <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                        <button class="fa fa-user-plus" aria-hidden="true" type="submit" ></button>
                        {!! Form::close() !!}
                    </div><!--form-group-->
                            <div class="form-group">
                                {!! Helper::getUserCount($ticket->id) !!}
                            </div>
                            </div>

                            <div class="form-group" style="padding:3px;">
                            <div class="form-group">
<a href="/comment/{{$ticket->id}}">
                                <button class="fa fa-commenting-o" aria-hidden="true" type="submit" ></button>
                                </a>
                                </div><!--form-group-->
                            <div class="form-group">
                            0
                            </div>
                            </div>
                            </div><!--form-inline-->
                            </div><!---col-md-2-->
                            </section>
                    </div>
                        <script>
                            var deadline = new Date('{{ $ticket->end }}');
                            initializeClock('clockdiv{{  $ticket->id}}', deadline);
              </script>
                            <hr>




                @endforeach
                    @else

                    <h2>К сожалению заявок нет, но вы можете <a href="{{ url('ticket/create') }}">создать тикет</a> </h2>

                @endif


            </div>
        </div>

    </div>
@endsection
