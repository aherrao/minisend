@extends('layouts.index')

@section('content')
	<mailer-index :prop_emails="{{ $jsonEmails }}"></mailer-index>
@endsection
