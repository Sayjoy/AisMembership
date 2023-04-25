@extends('templates.main')

@section('content')

<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8">
                <!-- POST -->
                <div class="post">
                    <div class="topwrap">
                        <div class="userinfo pull-left">
                            @php
                                if ($policy->user_id){
                                    $icon = '/images/icon6.jpg';
                                    $status = "Member";
                                    $user_roles = "";
                                    foreach ($policy->user->roles as $role){
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
                                title="{{$policy->name}}"
                                data-bs-content= "{{$status . $user_roles}}">
                                <div class="status green">&nbsp;</div>
                            </div>

                            <div class="icons">
                                <img src="{{url($icon)}}" alt="">
                                {{--  <img src="{{url('/images/icon1.jpg')}}" alt="">
                                <img src="{{url('/images/icon4.jpg')}}" alt="">
                                <img src="{{url('/images/icon5.jpg')}}" alt="">
                                <img src="{{url('/images/icon6.jpg')}}" alt="">  --}}
                            </div>
                        </div>
                        <div class="posttext pull-left">
                            <p>
                                <div class="float-start">
                                    @foreach ($policy->categories as $category)
                                    <a href="{{ route('discuss.byCategory', $category->id)}}">{{$category->name}}</a>
                                    @endforeach
                                </div>
                                <div class="float-end">
                                    Policy ID: {{$policy->policy_id}}
                                </div>
                                <div class="clearfix"></div>
                            </p>
                            <h2>{{$policy->title}}</h2>
                            <p>{!!$policy->details!!}</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="postinfobot">

                        {{--  <div class="likeblock pull-left">
                            <a href="#" class="up"><i class="fa fa-thumbs-o-up"></i>25</a>
                            <a href="#" class="down"><i class="fa fa-thumbs-o-down"></i>3</a>
                        </div>

                        <div class="prev pull-left">
                            <a href="#"><i class="fa fa-reply"></i></a>
                        </div>  --}}

                        <div class="posted pull-left">
                            <i class="fa fa-clock-o"></i> Posted on : {{$policy->created_at}}
                        </div>

                        <div class="next posted pull-right">
                            <i class="far fa-eye"></i> Views: {{$policy->views}}
                        </div>

                        {{--  <div class="next pull-right">
                            <a href="#"><i class="fa fa-share"></i></a>

                            <a href="#"><i class="fa fa-flag"></i></a>
                        </div>  --}}

                        <div class="clearfix"></div>
                    </div>
                </div>
                <!-- POST -->

                <!-- New comment -->
                <div class="post ms-5">
                    <form action="{{route('discuss.store')}}" class="form" method="post">
                        @csrf
                        <input type="hidden" name="policy_id" value="{{$policy->id}}">
                        <div class="topwrap">
                            <div class="userinfo pull-left">
                                @php
                                    $user_roles = "";
                                    foreach (Auth::user()->roles as $role){
                                        $user_roles.=" ".$role->name;
                                     }
                                @endphp

                                <div class="avatar">
                                    <img src="{{url('/images/avatar.jpg')}}" alt=""
                                    tabindex="0"
                                    data-bs-trigger="focus"
                                    data-bs-toggle="popover"
                                    title="{{Auth::user()->name}}"
                                    data-bs-content= "{{$user_roles}}">
                                    <div class="status green">&nbsp;</div>
                                </div>

                                <div class="icons">
                                    <img src="{{url('/images/icon6.jpg')}}" alt="">
                                </div>
                            </div>
                            <div class="posttext pull-left">
                                <div class="textwraper">
                                    <div class="postreply">Post a Reply</div>
                                    <textarea name="reply" class="wysiwyg @error('reply') is-invalid @enderror" id="reply" placeholder="Type your message here"></textarea>
                                    @error('reply')
                                        <span class="invalid-feedback" role="alert">
                                            {{$message}}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="postinfobot">

                            {{--  <div class="notechbox pull-left">
                                <input type="checkbox" name="note" id="note" class="form-control">
                            </div>

                            <div class="pull-left">
                                <label for="note"> Email me when some one post a reply</label>
                            </div>  --}}

                            <div class="pull-right postreply">
                                {{--  <div class="pull-left smile"><a href="#"><i class="fa fa-smile-o"></i></a></div>  --}}
                                <div class="pull-left"><button type="submit" class="btn btn-primary">Post Reply</button></div>
                                <div class="clearfix"></div>
                            </div>


                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
                <!-- End New Comment -->

                <!-- Discussions -->
                @php
                    $discussions = $policy->discussion()->orderBy('discussions.created_at', 'desc')->paginate(10);
                @endphp
                @foreach ($discussions as $discussion)
                    <div class="post ms-5">
                        <div class="topwrap">
                            <div class="userinfo pull-left">
                                @php
                                    $user_roles = "";
                                    foreach ($discussion->user->roles as $role){
                                        $user_roles.=" ".$role->name;
                                     }
                                @endphp

                                <div class="avatar">
                                    <img src="{{url('/images/avatar.jpg')}}" alt=""
                                    tabindex="0"
                                    data-bs-trigger="focus"
                                    data-bs-toggle="popover"
                                    title="{{$discussion->user->name}}"
                                    data-bs-content= "{{$user_roles}}">
                                    <div class="status green">&nbsp;</div>
                                </div>

                                <div class="icons">
                                    <img src="{{url('/images/icon6.jpg')}}" alt="">
                                </div>
                            </div>
                            <div class="posttext pull-left">
                                <p>{!! $discussion->reply !!}</p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="postinfobot">

                            {{--  <div class="likeblock pull-left">
                                <a href="#" class="up"><i class="fa fa-thumbs-o-up"></i>10</a>
                                <a href="#" class="down"><i class="fa fa-thumbs-o-down"></i>1</a>
                            </div>

                            <div class="prev pull-left">
                                <a href="#"><i class="fa fa-reply"></i></a>
                            </div>  --}}

                            <div class="posted pull-left"><i class="fa fa-clock-o"></i> Posted on : {{$discussion->created_at}} </div>

                            {{--  <div class="next pull-right">
                                <a href="#"><i class="fa fa-share"></i></a>

                                <a href="#"><i class="fa fa-flag"></i></a>
                            </div>  --}}

                            <div class="clearfix"></div>
                        </div>
                    </div>
                @endforeach
                <!-- Discussions -->



            </div>
            <div class="col-lg-4 col-md-4">

                <!-- Sidebar -->

                <div class="sidebarblock">
                    <h3>Approver Comment</h3>
                    <div class="divline"></div>
                    <div class="blocktxt">
                        <blockquote>
                            {{$policy->comment}} <br/>
                            - {{$policy->approver->name}}
                        </blockquote>

                        @can('is-admin-moderator')
                        <p>
                            <a href="{{route('policy.ideas.edit', $policy->id)}}" class="btn btn-primary">Edit Policy</a>
                        </p>
                        @endcan
                    </div>
                </div>

                    @include('policy.partials.sidebar')
                <!-- Sidebar -->

            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-xs-12 ms-5">
                {{$discussions->links()}}

                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</section>

@endsection
