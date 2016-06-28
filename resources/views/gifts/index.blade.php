@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
       {{--  @if (Session::has('status'))
            <p class='message'> {{ Session::get('status') }} </p>
        @endif --}}

            @if ($gift)
                @if ($gift->status==0)
                    <p class='message'> Gift sent. </p>
                @else ($gift->status==1)
                    <p class="message"> Gift receive. </p>
                @endif
            @else   		
	            <p> You can select a gift. </p>
	            {!! Form::open(array('route' => 'gifts.store', 'method'=>'post', 'role'=>'form')) !!}
  
	            <div class="form-group">
                    {!! Form::radio('gift_id', 1) !!}
                    <p class='name'> Name: Gift One </p>
                </div>	

                <div class="form-group">
                    {!! Form::radio('gift_id', 2) !!}
                    <p class='name'> Name: Gift Two </p>
                </div>  

	            <div class="form-group">
                    {!! Form::submit("Send gift", ['class'=>"btn btn-default"]) !!}
                </div>

				{!! Form::close() !!}
        	@endif
        </div>
    </div>
</div>
@endsection
