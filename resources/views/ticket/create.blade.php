@extends('layouts.app')

@section('style')


@endsection


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> <br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @elseif(\Session::has('message'))
                        <div class="alert alert-success">
                            <h4 text-align="center">{!! \Session::get('message') !!}</h4>
                        </div>
                    @endif

                        {!! Form::open(array('route' => 'ticket.store','method'=>'POST')) !!}
                        @include('ticket.form')
                    {!! Form::close() !!}
                </div>
            </div>

@endsection


    @section('script')

<script type="application/javascript">
            $(function(){
                $('.down-hours').click(function () {
                    var $hours = $(this).parent().find('.hours');
                    var count = parseInt($hours.val()) - 1;
                    count = count < 1 ? 1 : count;
                    $hours.val(count);
                    $hours.change();
                    return false;
                });
                $('.up-hours').click(function () {
                    var $input = $(this).parent().find('input');
                    var count = parseInt($input.val()) + 1;
                    count = count >= 24 ? 0 : count;
                    $input.val(count);
                    $input.change();
                    return false;
                });

                $('.up-minutes').click(function(){
                    var $input = $(this).parent().find('input');
                    var count = parseInt($input.val()) + 15;
                    count = count >= 60 ? 0 : count;
                    $input.val(count);
                    $input.change();
                    return false;
                });


                $('.down-minutes').click(function(){
                    var $input = $(this).parent().find('input');
                    var count = parseInt($input.val()) - 15;
                    count = count < 0 ? 0 : count;
                    $input.val(count);
                    $input.change();
                    return false;
                });
            });

    function today() {
          var now = new Date();


    }

    function tomorrow() {

    }

    function later() {

    }


</script>
  <script type="text/javascript">
            $(function () {
                $('#start').datetimepicker({ 'format': 'YYYY-MM-DD hh:mm:ss', locale:'ru'});
                $('#end').datetimepicker({
                    'format': 'YYYY-MM-DD hh:mm:ss',
                    locale: 'ru',
                    useCurrent: false //Important! See issue #1075
                });

                $("#start").on("dp.change", function (e) {
                    $('#end').data("DateTimePicker").minDate(e.date);
                });
                $("#start").on("dp.change", function (e) {
                    // $('#end').data("DateTimePicker").maxDate(e.date);
                });

            });
        </script>
@endsection
