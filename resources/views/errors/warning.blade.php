@section('warning')
    @parent
<div class="container">
    <div class="row">
    <div class="col-md-10 col-md-offset-1">
        @if (\Session::has('message'))
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
@endsection


