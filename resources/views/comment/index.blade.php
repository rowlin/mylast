@extends('layouts.app')

@section('content')

    <div class="container">
    <div class="row">
        <div class="col-md-9">
        <section>
            <h2>{{$ticket->name}}</h2>
            <h4>{{ $ticket->desc }}</h4>
            {{ $ticket->start}}  -  {{$ticket->end}}
        </section>
            <hr>
        </div>

        <div class="col-md-6">
@if(!empty($allcomments))
        @foreach($allcomments as $comment)
        <section>

           <h3> {{ $comment->comment }}</h3>
           <i> {{ $comment->created_at }}</i>
        </section>
        @endforeach
@else
<p> нет комментов</p>
@endif

    <!--форма для комментария -->
    </div>
</div>
        <div class="col-md-6">
            <h2>Оставить комментарий :</h2>
{!! Form::open(['method' =>'POST', 'route' => 'comment.create']) !!}
            <input type="hidden" name="ticket_id" value="{{$ticket->id}}">
         <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            <input type="hidden" name="parent_id" value="0" >
        <textarea name="comment" style=" width:100%" id="text"></textarea><br>
        <button class="fa fa-commenting-o" aria-hidden="true" type="submit">Комментировать</button>
{!! Form::close() !!}

    </div>
    </div>
@endsection