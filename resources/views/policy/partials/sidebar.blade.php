<div class="sidebarblock">
    <h3>Categories</h3>
    @foreach ($categories as $category)
        <div class="divline"></div>
        <div class="blocktxt">
            <ul class="cats">
                @if (isset($public))
                    <li><a href="{{ route('policies.published.byCategory', $category->id)}}">{{$category->name}} <span class="badge pull-right">
                        {{$category->policies->whereNotNull('published_at')->count()}}</span></a>
                    </li>
                @else
                    <li><a href="{{ route('discuss.byCategory', $category->id)}}">{{$category->name}} <span class="badge pull-right">{{$category->policies->where('approval', true)->whereNull('published_at')->count()}}</span></a></li>
                @endif
            </ul>
        </div>
    @endforeach

</div>

<!-- -->
<div class="sidebarblock">
    <h3>Active Poll</h3>
    <div class="divline"></div>
    <div class="blocktxt">
        @foreach ($activePolls as $poll)
            <p><b>{{$poll->name}}</b></p>
            <hr/>
            @php($k=0)
            <form action="{{route('poll.submit')}}" method="POST" class="form">
                @csrf
                <table class="poll table">
                    <tbody>
                    @foreach ($poll->questions as $question)
                        <tr>
                            <td>
                                {{$question->title}}
                                <div class="progress">
                                    <div class="progress-bar color{{++$k}}" role="progressbar" style="width: {{$question->percentageResponse()}}%" aria-valuenow="{{$question->percentageResponse()}}" aria-valuemin="0" aria-valuemax="100">
                                        {{$question->responder->count()}}
                                    </div>
                                </div>
                            </td>
                            <td class="chbox">
                                <input id="opt{{$question->id}}" type="radio" name="quest" value="{{$question->id}}">
                                <label for="opt{{$question->id}}"></label>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan=2>
                            @error('quest')
                                <span class="invalid-feedback" role="alert">
                                    {{$message}}
                                </span>
                            @enderror
                            <input type="hidden" name="poll_id" value="{{$poll->id}}">
                            <input type="submit" class="btn btn-primary">
                        </td>
                    </tr>
                </tbody></table>
            </form>
        @endforeach

        {{--  <p class="smal">Voting ends on 19th of October</p>  --}}
    </div>
</div>

<!-- -->
{{--  <div class="sidebarblock">
    <h3>My Active Threads</h3>
    <div class="divline"></div>
    <div class="blocktxt">
        <a href="http://forum.azyrusthemes.com/index.html#">This Dock Turns Your iPhone Into a Bedside Lamp</a>
    </div>

</div>  --}}
