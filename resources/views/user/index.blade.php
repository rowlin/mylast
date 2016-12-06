@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Профиль</div>
                    <div class="panel-body">
                        <div class="col-md-4">
                            <img src="{{$user->img}}">
                        </div>

                        <div class="col-md-8">
                            <h2>{{ $user->name }}</h2>
                            <p>Возраст: {{$user->age}}</p>
                            <p>Пол: {{$user->sex}}</p>
                            <p>Город: {{$user->sity}}</p>
                            <p>Телефон:{{$user->phone}}</p>
                            <p>Mail:{{$user->email}}</p>
                            <a href="/profile/edit">Редактировать профиль</a>
                            Мои тикеты:
                            Комментарии:
                        </div>
                    </div>
                    <!-- The Current User Can't Update The Post -->



                </div><!--panel-->
            </div>
        </div>
    </div>

@endsection