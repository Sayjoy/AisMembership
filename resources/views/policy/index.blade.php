@extends('templates.main')

@section('content')

    <div class="row">
        <div class="col-12">
            <h1 class="btm_margin float-start">Policy Ideas</h1>
        </div>
    </div>

    <div class="card">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Title</th>
                <th scope="col">Details</th>
                <th scope="col">Submited By</th>
                <th scope="col">Categories</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($policies as $policy)
                <tr>
                    <th scope="row">{{$policy->id}}</th>
                    <td>{{$policy->title}}</td>
                    <td>{!!$policy->details!!}</td>
                    <td>@if ($policy->user_id)
                            {{$policy->user->name}} (Member), <br/>
                            {{$policy->user->email}}, <br/>
                            {{$policy->user->phone}},
                        @else
                            {{$policy->name}} (Guest), </br>
                            {{$policy->email}}, </br>
                            {{$policy->phone}}
                        @endif
                    </td>
                    <td>@foreach ($policy->categories as $category)
                            {{$category->name}}
                        @endforeach
                    </td>
                    <td><p class="m-0 p-0">
                        @if ($policy->approval)
                            {!!$policy->approver? '<div class="row"><strong>Approved by '.$policy->approver->name.'</strong></div>':''!!}
                            {!!$policy->comment? '<div class="text-muted">'.$policy->comment.'</div>':''!!}

                            @php
                                $action = "Disapprove";
                                $class = "warning";
                                $value = False;
                            @endphp

                        @else
                            {!!$policy->approver? '<div class="row"><strong>Disapproved by '.$policy->approver->name.'</strong></div>':''!!}
                            {!!$policy->comment? '<div class="text-muted">'.$policy->comment.'</div>':''!!}

                            @php
                                $action = "Approve";
                                $class = "primary";
                                $value = True;
                            @endphp
                        @endif
                        <button type="button" class="btn btn-{{$class}}" data-bs-toggle="modal" data-bs-target="#approval-policy-{{$policy->id}}">
                            {{$action}}
                        </button>

                        <!-- Modal -->
                            <div class="modal fade" id="approval-policy-{{$policy->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{$action}} Policy</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{route('policy.approval')}}">
                                    @csrf
                                    <div class="modal-body">

                                        <div class="mb-3">
                                            <label for="details" class="form-label">Add a comment</label>
                                            <input type="hidden" name="action" value="{{$value}}">
                                            <input type="hidden" name="id" value="{{$policy->id}}">
                                            <textarea name="comment" class="form-control" id="body" rows="3"></textarea>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button name="submit" value="{{$action}}" type="submit" class="btn btn-{{$class}} me-auto">{{$action}}</button>
                                        {{--  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>  --}}
                                    </div>
                                </form>
                                </div>
                            </div>
                            </div>
                            <!--End Modal-->

                        </p>
                        <button type="button" class="btn btn-sm btn-danger"
                                onclick="event.preventDefault();
                                document.getElementById('delete-policy-form-{{ $policy->id }}').submit()">
                            Delete
                        </button>
                        <form id="delete-policy-form-{{ $policy->id }}" action="{{ route('policy.ideas.destroy', $policy->id)}}" method="POST" style="display:none">
                            @csrf
                            @method("DELETE")
                        </form>
                    </td>
                  </tr>
                @endforeach
            </tbody>
          </table>
          {{$policies->links()}}
    </div>

@endsection
