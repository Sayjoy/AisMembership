@extends('templates.main')

@section('content')

    <div class="row">
        <div class="col-12">
            <h1 class="btm_margin float-start">Categories</h1>
            <a class="btn btn-sm btn-success float-end" href="{{route('policy.category.create')}}" role="Button">Create</a>
        </div>
    </div>

    <div class="card">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">All</th>
                <th scope="col">Approved</th>
                <th scope="col">Published</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <th scope="row">{{$category->id}}</th>
                    <td><a href="{{ route('policy.byCategory', $category->id)}}"> {{$category->name}}</a></td>
                    <td>{{$category->policies->count()}}</td>
                    <td><a href="{{ route('discuss.byCategory', $category->id)}}">{{$category->policies->where('approval', true)->whereNull('published_at')->count()}}</a></td>
                    <td><a href="{{ route('policies.published.byCategory', $category->id)}}">{{$category->policies->whereNotNull('published_at')->count()}}</a></td>

                    <td>
                        <a href="{{route('policy.category.edit', $category->id)}}" class="btn btn-sm btn-info">Edit</a>
                        <button type="button" class="btn btn-sm btn-danger"
                                onclick="event.preventDefault();
                                document.getElementById('delete-category-form-{{ $category->id }}').submit()">
                            Delete
                        </button>
                        <form id="delete-category-form-{{ $category->id }}" action="{{ route('policy.category.destroy', $category->id)}}" method="POST" style="display:none">
                            @csrf
                            @method("DELETE")
                        </form>

                    </td>
                  </tr>
                @endforeach
            </tbody>
          </table>
    </div>

@endsection
