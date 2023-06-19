@extends('templates.main')

@section('content')

    <div class="row">
        <div class="col-12">
            <h1 class="btm_margin float-start">Edit Workgroup</h1>

    </div>

    <div class="card">
        <form method="POST" action="{{route('admin.workgroup.update', $workgroup->id)}}">
            @method('PATCH')
            @include('workgroup.partials.workgroup-form')
         </form>
    </div>

@endsection
