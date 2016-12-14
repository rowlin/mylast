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
        <section id="comment">

           <h3> {{ $comment->comment }}</h3>
           <i> {{ $comment->created_at }}</i>
        </section>
        @endforeach
@else
<p> Нет комментариев , вы можете быть первым)</p>
@endif

    <!--форма для комментария -->
    </div>
</div>
            <span id="msg"></span>
        <div class="col-md-6">
            <h2>Оставить комментарий :</h2>

        <input type="hidden" name="ticket_id" value="{{$ticket->id}}">
            <input type="hidden" name="user_id" value="{{ Auth::id() }}" >
        <textarea name="comment" style=" width:100%" id="text"></textarea><br>
        <button class="fa fa-commenting-o" aria-hidden="true" onclick="addcomment({!! $ticket->id !!})" type="submit">Комментировать</button>

    </div>
    </div>
@endsection

@section('script')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


        function addcomment(id) {
             $.ajax({
                type: 'post',
                url: 'create',
                data: {
                    'ticket_id': id,
                    'parent_id': '11',
                    'user_id': $('input[name=user_id]').val(),
                    'comment': $('textarea[name=comment]').val()
                },
                success:function(data){
                    $('section:last').append("<section><h3>" + data.comment + "</h3></section>");
                }
            });
        }


</script>
@endsection