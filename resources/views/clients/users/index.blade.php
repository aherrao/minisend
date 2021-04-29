@extends('layouts.index')

@section('content')
	<user-index :prop_users="{{ $jsonUsers }}" :prop_options="{{ $options }}"></user-index>
@endsection
