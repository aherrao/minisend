@extends('layouts.index')

@section('content')
	<mailer-show :prop_email="{{ $objEmail }}"></mailer-show>
@endsection
