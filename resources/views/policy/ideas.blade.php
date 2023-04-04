@extends('templates.main')

@section('content')
    <h1>Submit your Policy ideas here</h1>
    <div class="card">
    <form method="POST" action="{{route('policy.store')}}">
        @csrf
        <div class="mb-3">
        <label for="title" class="form-label">Policy Title *</label>
        <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" id="title" aria-describedby="title"
                value="{{old('title')}}">
        @error('title')
            <span class="invalid-feedback" role="alert">
                {{$message}}
            </span>
        @enderror
        </div>

        <div class="mb-3">
        <label for="details" class="form-label">Policy Details</label>
        <textarea name="details" class="form-control wysiwyg @error('details') is-invalid @enderror" id="details"></textarea></textarea>
        @error('details')
            <span class="invalid-feedback" role="alert">
                {{$message}}
            </span>
        @enderror
        </div>

        <div class="mb-3">
            <label for="categories" class="form-label">Policy Category</label>
            @foreach ($categories as $category)
                <div class="form-check">
                    <input class="form-check-input" name="categories[]"
                        type="checkbox" value="{{$category->id}}" id="{{$category->name}}"
                        @isset($policy)
                            @if (in_array($category->id, $user->rcategory->pluck('id')->toArray()))
                                checked
                            @endif
                        @endisset>
                    <label class="form-check-label" for="{{$category->name}}">
                        {{$category->name}}
                    </label>
                </div>
            @endforeach
        </div>

        <div class="mb-3">
        <label for="name" class="form-label">Name *</label>
        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="name"
                value="{{old('name')}} @auth {{ auth()->user()->name}} @endauth" @auth readonly @endauth>
        @error('name')
            <span class="invalid-feedback" role="alert">
                {{$message}}
            </span>
        @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email Address *</label>
            <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="email"
                    value="{{old('email')}}  @auth {{ auth()->user()->email}} @endauth" @auth readonly @endauth>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    {{$message}}
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" aria-describedby="phone"
                    value="{{old('phone')}}  @auth {{ auth()->user()->phone}} @endauth" @auth readonly @endauth>
            @error('phone')
                <span class="invalid-feedback" role="alert">
                    {{$message}}
                </span>
            @enderror
        </div>
        <button name="submit" type="submit" class="btn btn-primary">Submit</button>

    </form>
    </div>
@endsection


{{--  <x-app-layout>
    <div>Index of Policies</div>
</x-app-layout>  --}}
