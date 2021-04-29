@if($errors->any())
	<div class="alert alert-danger">
		<h4><i class="icon fa fa-ban"></i> Alert!</h4>
		@foreach($errors->all() as $error)
			<p>{{ $error }}</p>
		@endforeach
	</div>
@endif

@if(Session::has('flash_message'))
	<div class="alert alert-success">
		<i class="icon fa fa-check"></i> <b> Success! </b><span> {{ Session::get('flash_message') }} </span>
	</div>
@endif