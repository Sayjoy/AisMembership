
@if ($policy->approval)
{{--  Approved Policy, action = disapprove  --}}
    {!!$policy->approver? '<div class="row"><strong>Approved by '.$policy->approver->name.' ('.$policy->policy_id.')</strong></div>':''!!}
    @isset($comment)
        {!!$policy->comment? '<div class="text-muted">'.$policy->comment.'</div>':''!!}
    @endisset

    @php
        $action = "Disapprove";
        $class = "warning";
        $value = False;
    @endphp

@else
{{--  Unapproved Policy, action = approve  --}}
    {!!$policy->approver? '<div class="row"><strong>Disapproved by '.$policy->approver->name.'</strong></div>':''!!}
    @isset($comment)
        {!!$policy->comment? '<div class="text-muted">'.$policy->comment.'</div>':''!!}
    @endisset

    @php
        $action = "Approve";
        $class = "primary";
        $value = True;
    @endphp
@endif

@if ($policy->published_at)
{{--  Published Policy, action = unpublish  --}}
    <a role="button" href="{{route('policy.publish', $policy->id)}}" class="btn br0 btn-secondary">
        Unpublish
    </a>
@else
{{--  Unpublished Policy, action = Approve | Disapprove | Publish  --}}
    <button type="button" class="btn br0 btn-{{$class}}" data-bs-toggle="modal" data-bs-target="#approval-policy-{{$policy->id}}">
        {{$action}}
    </button>
    @if (isset($publish) & $policy->approval)
        <a role="button" href="{{route('policy.publish', $policy->id)}}" class="btn br0 btn-info">
            Publish
        </a>
    @endif
@endif


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
