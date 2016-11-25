@extends('layouts.app')

@section('style')
    <style>

        .form-group{
            margin-top:12px;
            padding-top:12px;
        }
    </style>

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
