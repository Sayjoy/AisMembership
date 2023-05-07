@csrf

@isset($edit)
    @if(count($poll->questions)>0)
    <h3>Edit Previous questions</h3>
    @endif
    @foreach ($poll->questions as $question)
        <div class="mb-3">
            <input name="old_questions[]" type="text" class="form-control" value="{{$question->title}}">
            <input type="hidden" name="ids[]" value="{{$question->id}}">
        </div>
    @endforeach
@endisset

@for ($i=0; $i<$q_no; $i++)
    <div class="mb-3">
        <label for="question" class="form-label">Poll Question {{ $i+1 }}</label>
        <input name="questions[]" type="text" class="form-control @error('question') is-invalid @enderror">
    </div>
@endfor

<input type="hidden" value="{{$poll->id}}" name="poll_id">
<button name="submit" type="submit" class="btn btn-primary">Submit</button>
