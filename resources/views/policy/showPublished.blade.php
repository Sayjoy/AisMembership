@extends('templates.main')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="float-start">
                <h3 class="btm_margin">{{$policy->policy_id}} - {{$policy->title}}</h3>
                <strong>by {{$policy->name}}</strong>
            </div>
            <div class="float-end">
                @foreach ($policy->categories as $category)
                    {{$category->name}}
                @endforeach
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card col-md-8">
            <div class="row">
                {!!$policy->details!!}
            </div>
        </div>
        <div class="col-lg-4 col-md-4">

            <!-- Sidebar -->
                @include('policy.partials.sidebar', ['public'=>true])
            <!-- Sidebar -->

        </div>
    </div>

@endsection
