@extends('templates.main')

@section('content')

    <div class="row">
        <div class="col-12">
            <h1 class="btm_margin float-start">Published Policies @isset($category) {{$category->name}} @endisset</h1>
        </div>
    </div>

    <div class="card">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Policy Id</th>
                <th scope="col">Details</th>
                <th scope="col">Submited By</th>
                <th scope="col">Categories</th>
                <th scope="col">Publish Date</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($policies as $policy)
                <tr>
                    <th scope="row">{{$policy->policy_id}}</th>
                    <td><a href="{{ route('policy.published', $policy->id)}}">{{$policy->title}}</a><br/>
                        {!!$policy->shortDetails()!!}</td>
                    <td>{{$policy->name}} ({{$policy->email}})</td>
                    <td>@foreach ($policy->categories as $category)
                            {{$category->name}}
                        @endforeach
                    </td>
                    <td>{{$policy->published_at}}</td>
                  </tr>
                @endforeach
            </tbody>
          </table>
          {{$policies->links()}}
    </div>

@endsection
