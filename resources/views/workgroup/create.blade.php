@extends('templates.main')

@section('content')

    <div class="row">
        <div class="col-12">
            <h1 class="btm_margin float-start">Create a Workgroup</h1>

    </div>

    <div class="card">
        <form method="POST" action="{{route('admin.workgroup.store')}}">
            @include('workgroup.partials.workgroup-form')
         </form>
    </div>

@endsection
