@php
$rd = "";
if (!isset($policy)){
    if(auth()->check()) {
        $rd = "readonly";
    }
    else {
        $rd = "";
    }
}
@endphp


@csrf
<div class="mb-3">
    <label for="title" class="form-label">Policy Title *</label>
    <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" id="title" aria-describedby="title"
            value="{{old('title')}}@isset($policy){{$policy->title}}@endisset">
    @error('title')
        <span class="invalid-feedback" role="alert">
            {{$message}}
        </span>
    @enderror
</div>

<div class="mb-3">
    <label for="details" class="form-label">Policy Details</label>
    <textarea name="details" class="form-control wysiwyg @error('details') is-invalid @enderror" id="details">
        {{old('details')}}@isset($policy){{$policy->details}}@endisset
    </textarea>
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

                    @if (in_array($category->id, $policy->categories->pluck('id')->toArray()))
                        checked
                    @endif
                @endisset
            >
            <label class="form-check-label" for="{{$category->name}}">
                {{$category->name}}
            </label>
        </div>
    @endforeach
</div>

@isset($edit)
    <div class="mb-3">
        <label for="details" class="form-label">Approver Comment</label>
        <textarea name="comment" class="form-control wysiwyg @error('comment') is-invalid @enderror" id="comment">{{old('comment')}}@isset($policy){{$policy->comment}}@endisset</textarea>
        @error('comment')
            <span class="invalid-feedback" role="alert">
                {{$message}}
            </span>
        @enderror
    </div>
@endisset

<div class="mb-3">
    <label for="name" class="form-label">Name *</label>
    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="name"
        value="{{old('name')}}@php
            if(isset($policy)){
                echo $policy->name;
            } elseif(auth()->check()) {
                echo auth()->user()->name;
            }
        @endphp"
        {{$rd}}
    >
    @error('name')
        <span class="invalid-feedback" role="alert">
            {{$message}}
        </span>
    @enderror
</div>

<div class="mb-3">
    <label for="email" class="form-label">Email Address *</label>
    <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="email"
    value="{{old('email')}}@php
    if(isset($policy)){
        echo $policy->email;
    } elseif(auth()->check()) {
        echo auth()->user()->email;
    }
    @endphp"
    {{$rd}}
    >
    @error('email')
        <span class="invalid-feedback" role="alert">
            {{$message}}
        </span>
    @enderror
</div>

<div class="mb-3">
    <label for="phone" class="form-label">Phone Number</label>
    <input name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" aria-describedby="phone"
    value="{{old('phone')}}@php
    if(isset($policy)){
        echo $policy->phone;
    } elseif(auth()->check()) {
        echo auth()->user()->phone;
    }
    @endphp"
    {{$rd}}
    >
    @error('phone')
        <span class="invalid-feedback" role="alert">
            {{$message}}
        </span>
    @enderror
</div>
<button name="submit" type="submit" class="btn btn-primary">Submit</button>
