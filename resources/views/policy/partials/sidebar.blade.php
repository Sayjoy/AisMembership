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
    <h3>Poll of the Week</h3>
    <div class="divline"></div>
    <div class="blocktxt">
        <p>Which game you are playing this week?</p>
        <form action="http://forum.azyrusthemes.com/index.html#" method="post" class="form">
            <table class="poll">
                <tbody><tr>
                    <td>
                        <div class="progress">
                            <div class="progress-bar color1" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 90%">
                                Call of Duty Ghosts
                            </div>
                        </div>
                    </td>
                    <td class="chbox">
                        <input id="opt1" type="radio" name="opt" value="1">
                        <label for="opt1"></label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="progress">
                            <div class="progress-bar color2" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 63%">
                                Titanfall
                            </div>
                        </div>
                    </td>
                    <td class="chbox">
                        <input id="opt2" type="radio" name="opt" value="2" checked="">
                        <label for="opt2"></label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="progress">
                            <div class="progress-bar color3" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 75%">
                                Battlefield 4
                            </div>
                        </div>
                    </td>
                    <td class="chbox">
                        <input id="opt3" type="radio" name="opt" value="3">
                        <label for="opt3"></label>
                    </td>
                </tr>
            </tbody></table>
        </form>
        <p class="smal">Voting ends on 19th of October</p>
    </div>
</div>

<!-- -->
<div class="sidebarblock">
    <h3>My Active Threads</h3>
    <div class="divline"></div>
    <div class="blocktxt">
        <a href="http://forum.azyrusthemes.com/index.html#">This Dock Turns Your iPhone Into a Bedside Lamp</a>
    </div>

</div>
