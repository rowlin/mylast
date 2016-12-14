@extends('layouts.app')

@section('style')
<style type='text/css'>

.clockdiv div > input {
    width: 40px;
    height: 40px;
    font-size: 2rem;
    border: 0px;
    text-align: center;
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
        <div class="box">
        <div id="msg" style="text-align: center;">Тест</div>
        </div>
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
                                    <button class="fa fa-heart" aria-hidden="true" onclick="addlike({{ $ticket->id }})"  type="submit" ></button>
                                </div><!--form-group-->
                            <div class="form-group">
                                <span id="likeCount{!! $ticket->id !!}">{!! Helper::getLikeCount($ticket->id) !!}</span>
                            </div>
                        </div>

                            <div class="form-group" style="padding:3px;">

                            <div class="form-group">
                        <button class="fa fa-user-plus" aria-hidden="true" type="submit" onclick="invite({{ $ticket->id }})" ></button>
                            </div><!--form-group-->
                            <div class="form-group">
                                <span id="userCount{!! $ticket->id !!}">{!! Helper::getUserCount($ticket->id) !!}</span>
                            </div>
                            </div>

                            <div class="form-group" style="padding:3px;">
                            <div class="form-group">
                                <a href="/comment/{{$ticket->id}}">
                                <button class="fa fa-commenting-o" aria-hidden="true" type="submit" ></button>
                                </a>
                                </div><!--form-group-->
                            <div class="form-group">
                            {!! Helper::getCommentCount($ticket->id) !!}
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

@section('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function addlike(id) {
            $.ajax({
                type: 'post',
                url: 'addlike',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'ticket_id': id,
                },
                success:function(data){
                    $("#msg").html(data.msg);
                    $("#likeCount"+id).html(data.count);
                }
            });
        }

        function invite(id){
            $.ajax({
                type: 'post',
                url: 'adduser',
                data:{
                    '_token': $('input[name= _token]').val(),
                    'ticket_id': id,
                },
                success:function (data) {
                    $('#msg').html(data.msg);
                    $("#userCount"+id).html(data.count);

                }
            });
        }

    </script>
@endsection


