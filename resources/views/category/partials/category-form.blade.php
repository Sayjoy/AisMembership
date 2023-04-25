@csrf
<div class="mb-3">
  <label for="name" class="form-label">name</label>
  <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="name"
        value="{{old('name')}}@isset($category){{ $category->name}}@endisset">
  @error('name')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
  @enderror
</div>
<button name="submit" type="submit" class="btn btn-primary">Submit</button>
