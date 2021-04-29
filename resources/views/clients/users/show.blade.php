@extends('layouts.index')

@section('content')
	<user-show :prop_user="{{ $objUser }}" :prop_user_options="{{ $arrUserOptions }}"></user-show>
@endsection
