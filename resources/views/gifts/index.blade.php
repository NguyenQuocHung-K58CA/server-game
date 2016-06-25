@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @if (session('status'))
                <p class='message'> {{ session('status') }} </p>
            @endif

            @if ($isReceive)
                <p> Your gift sent! </p>
        	@elseif ($isSend)
        		<p> Your request are pending. </p>
        	@else   		
	            <p> You can select a gift. </p>
	            {!! Form::open(array('route' => 'giftdetail.store', 'method'=>'post', 'role'=>'form')) !!}
	            {!! Form::hidden('user_id', Auth::user()->id) !!}

	            @foreach($gifts as $gift)          
		            @include("gifts.item", $gift)  	
	            @endforeach

	            @include("gifts.send")

				{!! Form::close() !!}
        	@endif
        </div>
    </div>
</div>
@endsection
