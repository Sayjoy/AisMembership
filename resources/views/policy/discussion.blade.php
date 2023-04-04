@extends('templates.main')

@section('content')

<section class="content">
    {{--  <div class="container">
        <div class="row">
            <div class="col-lg-8 col-xs-12 col-md-8">
                <div class="pull-left"><a href="http://forum.azyrusthemes.com/index.html#" class="prevnext"><i class="fa fa-angle-left"></i></a></div>
                <div class="pull-left">
                    <ul class="paginationforum">
                        <li class="hidden-xs"><a href="http://forum.azyrusthemes.com/index.html#">1</a></li>
                        <li class="hidden-xs hidden-md"><a href="http://forum.azyrusthemes.com/index.html#">11</a></li>
                        <li class="hidden-xs hidden-sm hidden-md"><a href="http://forum.azyrusthemes.com/index.html#">13</a></li>
                        <li><a href="http://forum.azyrusthemes.com/index.html#">1586</a></li>
                    </ul>
                </div>
                <div class="pull-left"><a href="http://forum.azyrusthemes.com/index.html#" class="prevnext last"><i class="fa fa-angle-right"></i></a></div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>  --}}


    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8">
                <!-- POST -->
                @foreach ($approvedIdeas as $idea)
                    <div class="post">
                        <div class="wrap-ut pull-left">
                            <div class="userinfo pull-left">
                                <div class="avatar">
                                    <img src="{{url('/images/avatar.jpg')}}"
                                        data-toggle="popover"
                                        data-trigger="hover"
                                        title="Some title"
                                        data-content="Some multiple comments">
                                    <div class="status green">&nbsp;</div>

                                </div>

                                <div class="icons">
                                    <img src="{{url('/images/icon1.jpg')}}" alt=""><img src="{{url('/images/icon4.jpg')}}" alt="">
                                </div>
                            </div>
                            <div class="posttext pull-left">
                                <h2><a href="{{ route('discuss.show', $idea->id)}}">{{$idea->title}}</a></h2>
                                <p>{!! $idea->shortDetails() !!}</p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="postinfo pull-left">
                            <div class="comments">
                                <div class="commentbg">
                                    560
                                    <div class="mark"></div>
                                </div>

                            </div>
                            <div class="views"><i class="far fa-eye"></i> 1,568</div>
                            <div class="time"><i class="far fa-clock-o"></i> {{$idea->created_at->diffForHumans()}}</div>
                        </div>
                        <div class="clearfix"></div>
                    </div><!-- POST -->
                @endforeach

            </div>
            <div class="col-lg-4 col-md-4">

                <!-- -->
                <div class="sidebarblock">
                    <h3>Categories</h3>
                    @foreach ($categories as $category)
                        <div class="divline"></div>
                        <div class="blocktxt">
                            <ul class="cats">
                                <li><a href="#filterByCategoryName">{{$category->name}} <span class="badge pull-right">{{$category->policies->count()}}</span></a></li>
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


            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
      $('[data-toggle="popover"]').popover({
        html: true,
        placement: 'auto left'
      });
    });
  </script>

@endsection
