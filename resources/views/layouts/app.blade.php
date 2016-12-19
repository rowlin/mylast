<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Last') }}</title>
    <!-- Styles -->
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <link href="{{url('/css/all.css')}}" rel="stylesheet">
    @yield('style')
    <!-- Scripts -->
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li><a href="{{ url('/today') }}">Сегодня</a></li>
                        <li><a href="{{ url('/tomorrow') }}">Завтра</a></li>
                        <li><a href="{{ url('/later') }}">Потом</a></li>
                        <li><a href="{{ url('/all') }}">ВСЕ</a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Вход</a></li>
                            <li><a href="{{ url('/register') }}">Регистрация</a></li>
                            <li class="dropdown">
                                <a href="" data-toggle="modal" id="city_display" data-target="#myModal"> Город : {!! Helper::getGeoLocation("en") !!}</a>
                            </li>

                            <ul class="dropdown-menu" id="city-box"   role="menu">
                            <h2>Ваш город {!!  Helper::getGeoLocation("ru") !!}</h2>
                                <button type="button" onclick="setCookie('{!!  Helper::getGeoLocation("en") !!}')" >Да</button>
                                <button type="button" data-toggle="modal" data-target="#myModal"> Нет</button>
                            </ul>



                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>


                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="/ticket">Мои тикеты</a></li>
                                    <li><a href="/profile">Профиль</a></li>
                                    @if(Auth::user()->inRole('Admin'))
                                        <li><a href="{{ url('/admin') }}">Роли</a></li>
                                    @endif
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Выход
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown"><a href="" id="city_display" data-toggle="modal" data-target="#myModal" >Город : {!!  Helper::getGeoLocation("ru") !!}</a></li>

                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <!--errors-->
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    @if (\Session::has('msg'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{!! \Session::get('message') !!}</li>
                            </ul>
                        </div>
                    @endif
                    @if (\Session::has('message-alert'))
                        <div class="alert alert-error">
                            <ul>
                                <li>{!! \Session::get('message-alert') !!}</li>
                            </ul>
                        </div>
                    @endif

                    @if($errors->any())
                        <h4>{{$errors->first()}}</h4>
                    @endif

                </div>
            </div>
        </div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Выберете город</h4>
      </div>
      <div class="modal-body">
        <select>
            <option value="Sankt-peterburg">Санкт-Петербург</option>
            <option value="Moscow">Москва</option>
            <option value="Tallinn">Таллинн</option>
            <option value="Narva">Нарва</option>
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
        <button type="button" onclick="setCookie($('select').val())" class="btn btn-primary">Сохранить изменения</button>
      </div>
    </div>
  </div>
</div>
        <!--errors-->
        @yield('content')
    </div>
    <!-- Scripts -->
    <script src="/js/all.js"></script>
    @yield('script')
<script>

    function setCookie(value) {
        $.ajax({
            type: 'post',
            url: 'putcity',
            data:{
                '_token': $('input[name= _token]').val(),
                'city': value,
            },
            success:function (data) {
                $('#city-box').css('display','none');
                $('#city_display').text(value);
            }
        });
    }

    </script>

</body>
</html>
