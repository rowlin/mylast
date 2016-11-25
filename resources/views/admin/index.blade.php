@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Админка</div>

                    <div class="panel-body">

                        <table>
                            <thead>
                            <tr>
                                <td>Имя</td>
                                <td>Почта</td>
                                <td>Admin</td>
                                <td>Author</td>
                                <td>User</td>
                                <td></td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $users as $user)
                                <tr>
                                    <form action="{{route('admin.assign')}}" method="post">
                                    <td>{{$user->name}}</td>
                                    <td>{{ $user->email }}<input type="hidden" name="email" value="{{$user->email}}"></td>
                                    <td><input type="checkbox" {{ $user->hasRole('Admin') ? "checked" : " "}} name="role_admin" ></td>
                                    <td><input type="checkbox" {{ $user->hasRole('Author') ? "checked" : " "}} name="role_author"></td>
                                    <td><input type="checkbox" {{ $user->hasRole('User') ? "checked" : " "}} name="role_user" ></td>
                                {{ csrf_field() }}


                                    <td><button type="submit">Assign Roles</button></td>
                               </form>
                                </tr>



                            @endforeach

                            </tbody>
                        </table>


                    </div>
                    <!-- The Current User Can't Update The Post -->


                </div><!--panel-->
            </div>
        </div>
    </div>
@endsection
