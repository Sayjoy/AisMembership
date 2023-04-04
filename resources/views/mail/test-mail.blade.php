@extends('mail.layout.main')

@section('title')
    {{$mailDetails['title']}}
@endsection

@section('content')
    {{$mailDetails['body']}}
@endsection
