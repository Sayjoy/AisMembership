@extends('templates.main')

@section('content')

    <div class="row">
        <div class="col-12">
            <h1 class="btm_margin float-start">Users</h1>
            <a class="btn btn-sm btn-success float-end" href="{{route('admin.users.create')}}" role="Button">Create</a>
        </div>
    </div>

    <div class="card">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Country</th>
                <th scope="col">Roles</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <th scope="row">{{$user->id}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->phone}}</td>
                    <td>{{$user->country}}</td>
                    <td>@foreach ($user->roles as $role)
                            {{$role->name}}
                        @endforeach
                    </td>
                    <td>
                        <a class="btn btn-sm btn-primary" href="{{route('admin.users.edit', $user->id)}}" role="Button">Edit</a>
                        <button type="button" class="btn btn-sm btn-danger"
                                onclick="event.preventDefault();
                                document.getElementById('delete-user-form-{{ $user->id }}').submit()">
                            Delete
                        </button>
                        <form id="delete-user-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id)}}" method="POST" style="display:none">
                            @csrf
                            @method("DELETE")
                        </form>
                    </td>
                  </tr>
                @endforeach
            </tbody>
          </table>
          {{$users->links()}}
    </div>

@endsection
