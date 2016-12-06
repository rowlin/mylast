@extends('layouts.app')

@section('content')
    <div class="container" xmlns="http://www.w3.org/1999/html">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Профиль</div>
                    <div class="panel-body">
                        <div class="col-md-4">
                            <img src="{{$user->img}}">
                        </div>

                        <div class="col-md-8">
                            {!! Form::open(['method' =>'POST', 'route' => 'profile.update']) !!}
                            <div class="form-group">
                                <label for="name">Имя :</label>
                                <input type="text" name="name" value="{{ $user->name}}">
                            </div><!--form-group-->
                            <div class="form-group">
                                <label for="sex">Пол :</label>
                                <select name="sex">
                                <option value="1">Мужской</option>
                                <option value="0">Женский</option>
                                </select>
                            </div><!--form-group-->
                            <div class="form-group">
                                <label for="age">Возраст :</label>
                            <select name="age">
                                <?php  ?>
                                @for($i=16; $i < 56; $i++)
                                    <option value="{{$i}}" >{{ $i }}</option>
                                    @endfor
                            </select>
                                </div><!--form-group-->
                            <div class="form-group">
                                <label for="sity">Город :</label>
                                <input type="text" name="sity" value="{{ $user->sity}}">
                            </div><!--form-group-->
                            <div class="form-group">
                                <label for="phone">Телефон :</label>
                                <input type="phone" name="phone" value="{{ $user->phone}}">
                            </div><!--form-group-->
                            <div class="form-group">
                                <label for="email">Mail :</label>
                                <input type="email" name="ename" value="{{ $user->email}}">
                            </div><!--form-group-->
                            <button class="btn" type="submit">Сохранить</button>
                                {!! Form::close() !!}

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