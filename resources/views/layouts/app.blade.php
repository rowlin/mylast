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
                                <a  href="#" data-toggle="dropdown" role="button" aria-expanded="false">Город : {!!  Helper::getGeoLocation("ru") !!}</a>
                            </li>

                            <ul class="dropdown-menu" id="sity-box"   role="menu">
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
                            <li class="dropdown"><a href="#">Город : {!!  Helper::getGeoLocation("ru") !!}</a></li>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="profile/change">Изменить город</a></li>
                            </ul>
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
            <option value=" ">Санкт-Петербург</option>
            <option>Москва</option>
            <option>Таллинн</option>
            <option>Нарва</option>
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
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
    $(window).load(function() {
        if(Cookies.get('sity') === null || Cookies.get('sity') === "" ){
            $('#sity-box').css('display','block');
            console.log('empty')
        }else {
            if (typeof Cookies.get('sity')==='undefined'){
                $('#sity-box').css('display','block');
                console.log(Cookies.get('sity'));
            }
            console.log('empty')
        }
    });

    function setCookie(value) {
      Cookies.set('sity', value);
     $('#sity-box').css('display','none');
    }


    </script>

</body>
</html>
