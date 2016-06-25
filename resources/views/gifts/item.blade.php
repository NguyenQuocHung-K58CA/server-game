<div class="form-group">
    {!! Form::radio('gift_id', $gift->id) !!}
    <p class='description'> Name: {{$gift->name}} </p>
    <p class='description'> Description: {{$gift->description}} </p>
</div>