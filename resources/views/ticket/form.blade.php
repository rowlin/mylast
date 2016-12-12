<div class="form-group">
    <label for="name"  class="control-label">Название:</label>
    {!! Form::text('name', null, array('placeholder' => 'Название события','class' => 'form-control')) !!}
</div><!--.form-group-->

<div class="form-group">
    <label for="desc"  class="control-label">Описание:</label>
    {!! Form::textarea('desc', null, array('placeholder' => 'Описание','class' => 'form-control','style'=>'height:100px')) !!}
</div><!--.form-group-->

<div class="form-group">
    <label for="tags" class="control-label">Tags:</label>
    {!! Form::text('tags', null, array('placeholder' => 'Введите теги','class' => 'form-control','data-role' => 'tagsinput')) !!}
</div>

<div class="container">
<div class="form-group">
    <div class="col-sm-4">
        <label for="start" class="control-label">Начало:</label>
       <div class="input-group">
           <button type="button" class="btn btn-primary" onclick="today()" style="width: 100px;">Cегодня</button>
       </div>
          <div class="input-group">
            <button type="button" class="btn btn-primary " onclick="tomorrow()" style="width: 100px;">Завтра</button>
          </div>
        <div class="input-form" >
       <button type="button" class="btn btn-primary" onclick="later()" style="width: 100px;">Потом</button>
         </div>

    </div><!--col-sm-4-->
    <div class="form-group" >
    <div class="col-sm-4">
        <div class="clockdiv" >
            <div>
                <div class="up-hours">+</div>
                <input class="hours" value="1" readonly/>
                <div class="down-hours">-</div>
                <div class="smalltext">Часов</div>
            </div>
            <div>
                <div class="up-minutes">+</div>
                <input class="minutes" value='0' readonly/>
                <div class="down-minutes">-</div>
                <div class="smalltext">Минут</div>
            </div>
        </div>
    </div><!--col-sm-4-->
</div>
 <div class="form-group">
    <div class="col-sm-4">
        <div class="clockdiv" >

            <div>
                <div class="up-hours">+</div>
                <input class="hours" value="1"  readonly/>
            <div class="down-hours">-</div>
                <div class="smalltext">Часов</div>
            </div>

            <div>
                <div class="up-minutes">+</div>
                <input class="minutes" value='0' readonly/>
                <div class="down-minutes">-</div>
                <div class="smalltext">Минут</div>
            </div>
        </div>
    </div><!--col-sm-4-->
</div>

</div><!--form-group-->
</div>
<div class="form-group"><!--для кого-->
    <div class="col-sm-4">
        <label for="who_sex" class="control-label">С кем</label>
        <!--Form::select('who_sex', array('L' => 'Large', 'S' => 'Small'))-->

        <select name="who_sex">
            <option value="0" >С парнем</option>
            <option value="1">С девушкой</option>
            <option value="2" selected="selected">Не важно</option>
        </select>
    </div>
    <div class="col-sm-4">
        <label for="who_age" class="control-label">Возраст</label>
        <select name="who_age">
            <option value="0">14-16</option>
            <option value="1" selected="selected">16-18</option>
            <option value="2">18-20</option>
            <option value="3">20-22</option>
            <option value="4">22-24</option>
            <option value="5">24-26</option>
        </select>
    </div><!--col-sm-6-->
    <div class="col-sm-4">
        <label for="public" class="control-label">Опубликовать</label>
        <input type="checkbox" name="public" value="1"></a>
    </div>

</div><!--form-group-->
<!--заглушки-->


<input type="hidden" name="city" value="СПБ" />

<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

<div class="form-group" style="padding:10px;">
    {!! Form::submit('Отправить', ['class' => 'btn btn-primary']) !!}
</div>
