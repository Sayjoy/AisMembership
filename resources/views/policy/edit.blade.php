@extends('templates.main')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1 class="btm_margin float-start">Edit Policy</h1>
            <span class="float-end">
                @include('policy.partials.policy-actions', ['policy' => $policy, 'publish' => true])
            </span>

        </div>
    </div>
    <div class="card">
    <form method="POST" action="{{route('policy.ideas.update', $policy->id)}}">
        @method('PATCH')
        @include('policy.partials.policy-form', ['edit'=>true])
    </form>
    </div>
@endsection


{{--  <x-app-layout>
    <div>Index of Policies</div>
</x-app-layout>  --}}
