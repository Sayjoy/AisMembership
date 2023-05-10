@extends('templates.main')

@section('content')
<h1>Submit your Policy ideas here</h1>
    <div class="row">
        <div class="col-md-8">

            <div class="card">
                <form method="POST" action="{{route('policy.store')}}">
                    @include('policy.partials.policy-form')
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <!-- Sidebar -->
            @include('policy.partials.sidebar')
            <!-- Sidebar -->
        </div>
    </div>

@endsection


{{--  <x-app-layout>
    <div>Index of Policies</div>
</x-app-layout>  --}}
