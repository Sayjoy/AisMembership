@extends('templates.main')

@section('content')

    <div class="row">
        <div class="col-12">
            <h1 class="btm_margin float-start">Create Category</h1>

    </div>

    <div class="card">
        <form method="POST" action="{{route('policy.category.store')}}">
            @include('category.partials.category-form')
         </form>
    </div>

@endsection
