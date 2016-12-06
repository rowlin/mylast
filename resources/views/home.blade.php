@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <a href="ticket/create" class="btn">Создать тикет</a>
                    <a href="/profile/edit">Редактировать профиль</a>
                </div>
                        <!-- The Current User Can't Update The Post -->



            </div><!--panel-->
        </div>
    </div>
</div>
@endsection
