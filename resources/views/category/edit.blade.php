@extends('templates.main')

@section('content')

    <div class="row">
        <div class="col-12">
            <h1 class="btm_margin float-start">Edit Category</h1>

    </div>

    <div class="card">
        <form method="POST" action="{{route('policy.category.update', $category->id)}}">
            @method('PATCH')
            @include('category.partials.category-form')
         </form>
    </div>

@endsection
