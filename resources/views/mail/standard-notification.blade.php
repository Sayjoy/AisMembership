@extends('mail.layout.main')

@section('title')
    {!!$mailDetails['title']!!}
@endsection

@section('body')
    {!!$mailDetails['body']!!}
@endsection

@section('footer')
    {!!$mailDetails['footer']!!}
@endsection
