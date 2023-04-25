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
                <!-- Heading -->
                @isset($category)
                    <h1>Policies of {{$category->name}} Category</h1>
                @endisset
                <!-- Heading -->

                <!-- POST -->
                @foreach ($approvedIdeas as $idea)
                    <div class="post">
                        <div class="wrap-ut pull-left">
                            <div class="userinfo pull-left">
                                @php
                                if ($idea->user_id){
                                    $icon = '/images/icon6.jpg';
                                    $status = "Member";
                                    $user_roles = "";
                                    foreach ($idea->user->roles as $role){
                                        $user_roles.=", ".$role->name;
                                    }

                                }
                                else {
                                    $icon = '/images/icon4.jpg';
                                    $status = "Guest";
                                    $user_roles = "";
                                }

                            @endphp
                            <div class="avatar">
                                <img src="{{url('/images/avatar.jpg')}}" alt=""
                                tabindex="0"
                                data-bs-trigger="focus"
                                data-bs-toggle="popover"
                                title="{{$idea->name}}"
                                data-bs-content= "{{$status . $user_roles}}">
                                <div class="status green">&nbsp;</div>

                                </div>

                                <div class="icons">
                                    <img src="{{url('/images/icon1.jpg')}}" alt=""><img src="{{url('/images/icon4.jpg')}}" alt="">
                                </div>
                            </div>
                            <div class="posttext pull-left">
                                <h2><a href="{{ route('policy.show', $idea->id)}}">{{$idea->title}}</a></h2>
                                <p>{!! $idea->shortDetails() !!}</p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="postinfo pull-left">
                            <div class="comments">
                                <div class="commentbg">
                                    {{$idea->discussion->count()}}
                                    <div class="mark"></div>
                                </div>

                            </div>
                            <div class="views"><i class="far fa-eye"></i> {{$idea->views}}</div>
                            <div class="time"><i class="far fa-clock-o"></i> {{$idea->created_at->diffForHumans()}}</div>
                        </div>
                        <div class="clearfix"></div>
                    </div><!-- POST -->
                @endforeach

            </div>
            <div class="col-lg-4 col-md-4">

                <!-- Sidebar -->
                    @include('policy.partials.sidebar')
                <!-- Sidebar -->

            </div>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-xs-12">
                {{$approvedIdeas->links()}}
                {{--  <div class="pull-left"><a href="http://forum.azyrusthemes.com/index.html#" class="prevnext"><i class="fa fa-angle-left"></i></a></div>
                <div class="pull-left">
                    <ul class="paginationforum">
                        <li class="hidden-xs"><a href="http://forum.azyrusthemes.com/index.html#">1</a></li>
                        <li class="hidden-xs"><a href="http://forum.azyrusthemes.com/index.html#">2</a></li>

                    </ul>
                </div>
                <div class="pull-left"><a href="http://forum.azyrusthemes.com/index.html#" class="prevnext last"><i class="fa fa-angle-right"></i></a></div>  --}}
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</section>

@endsection
