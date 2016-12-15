@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="com-md-12">
            <div class="com-md-2">
            <ul class="list-inline">
                <li><a href="/profile">Профиль</a></li>
                <li><a href="/mylike">Мои лайки</a></li>
                <li><a href="/igo">Я иду</a></li>

                </ul>
        </div>

        <div class="col-md-8">
                    <a href="ticket/create" class="btn">Создать тикет</a>
                    <a href="/profile/edit">Редактировать профиль</a>
        </div>
            </div>
</div>
@endsection
