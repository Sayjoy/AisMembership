@extends('templates.main')

@section('content')
    <h1>Submit your Policy ideas here</h1>
    <div class="card">
    <form method="POST" action="{{route('policy.store')}}">
        @include('policy.partials.policy-form')
    </form>
    </div>
@endsection


{{--  <x-app-layout>
    <div>Index of Policies</div>
</x-app-layout>  --}}
