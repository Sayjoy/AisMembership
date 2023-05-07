@csrf
<div class="mb-3">
    <label for="name" class="form-label">Poll Name *</label>
    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="name"
            value="{{old('name')}}@isset($poll){{$poll->name}}@endisset">
    @error('name')
        <span class="invalid-feedback" role="alert">
            {{$message}}
        </span>
    @enderror
</div>

<div class="mb-3">
    <label for="no" class="form-label">How many questions to add?</label>
    <select name="no" class="form-control">
        <option value="0">  0  </option>
        <option value="1">  1  </option>
        <option value="2">  2  </option>
        <option value="3">  3  </option>
        <option value="4">  4  </option>
        <option value="5">  5  </option>
        <option value="6">  6  </option>
        <option value="7">  7  </option>
        <option value="8">  8  </option>
        <option value="9">  9  </option>
        <option value="10"> 10   </option>
    </select>
    @error('no')
        <span class="invalid-feedback" role="alert">
            {{$message}}
        </span>
    @enderror
</div>

<div class="mb-3">
    <div class="form-check form-switch">
        <input class="form-check-input" name="status" value="1" type="checkbox"
        id="flexSwitchCheckChecked" @isset($poll) @empty(!$poll->status) checked @endempty
        @endisset>
        <label class="form-check-label" for="flexSwitchCheckChecked">
            @isset($poll)
                {{$poll->state()}}
            @else
                Inactive
            @endisset
        </label>
      </div>
</div>


<button name="submit" type="submit" class="btn btn-primary">Submit</button>
