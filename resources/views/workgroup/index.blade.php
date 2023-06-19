@extends('templates.main')

@section('content')

    <div class="row">
        <div class="col-12">
            <h1 class="btm_margin float-start">Workgroups</h1>
            <a class="btn btn-sm btn-success float-end" href="{{route('admin.workgroup.create')}}" role="Button">Create</a>
        </div>
    </div>

    <div class="card">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Members</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($workgroups as $key => $workgroup)
                <tr>
                    <th scope="row">{{$key + 1}}</th>
                    <td><a href="{{ route('admin.workgroup.show', $workgroup->id)}}"> {{$workgroup->name}}</a></td>
                    <td>{{$workgroup->users->count()}}</td>

                    <td>
                        <a href="{{route('admin.workgroup.edit', $workgroup->id)}}" class="btn btn-sm btn-info">Edit</a>
                        <button type="button" class="btn btn-sm btn-danger"
                                onclick="event.preventDefault();
                                document.getElementById('delete-workgroup-form-{{ $workgroup->id }}').submit()">
                            Delete
                        </button>
                        <form id="delete-workgroup-form-{{ $workgroup->id }}" action="{{ route('admin.workgroup.destroy', $workgroup->id)}}" method="POST" style="display:none">
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
