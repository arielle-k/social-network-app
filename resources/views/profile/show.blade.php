@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div>
                <div class="content social-timeline">
                    <div class="">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="social-wallpaper">
                                    <div class="profile-hvr">
                                        <i class="icofont icofont-ui-edit p-r-10"></i>
                                        <i class="icofont icofont-ui-delete"></i>
                                    </div>
                                </div>
                                <div class="timeline-btn">
                                    <a href="#" class="btn btn-primary waves-effect waves-light m-r-10">follows</a>
                                    <a href="{{ route('chatify') }}" class="btn btn-primary waves-effect waves-light">Send Message</a>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-3 col-lg-4 col-md-4 col-xs-12">
                                <div class="social-timeline-left">
                                    <div class="card">
                                        <div class="social-profile">
                                            <img class="img-fluid width-100" src="{{ asset('storage/avatars') }}/{{ $profile->avatar }}" alt="">
                                            <div class="profile-hvr m-t-15">
                                                <i class="icofont icofont-ui-edit p-r-10"></i>
                                                <i class="icofont icofont-ui-delete"></i>
                                            </div>
                                        </div>
                                        <div class="card-block social-follower">
                                            <h4>{{ $profile->user->name }}</h4>
                                            <h5>{{ $profile->gender }}</h5>
                                            <div class="row follower-counter">
                                                <div class="col-4">
                                                    <button class="btn btn-primary btn-icon" data-toggle="tooltip" data-placement="top" title="" data-original-title="485">
                                                        <i class="fa fa-user"></i>
                                                    </button>
                                                </div>
                                                <div class="col-4">
                                                    <button class="btn btn-danger btn-icon" data-toggle="tooltip" data-placement="top" title="" data-original-title="2k">
                                                        <i class="fa fa-thumbs-o-up"></i>
                                                    </button>
                                                </div>
                                                <div class="col-4">
                                                    <button class="btn btn-success btn-icon" data-toggle="tooltip" data-placement="top" title="" data-original-title="90">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            @if (Auth::check() && Auth::user()->id !== $user->id)
                                            @if (Auth::user()->friends->contains($user))
                                                <div class="">
                                                    <form action="" method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                    <button type="submit" class="btn btn-danger waves-effect btn-block toggle-button" data-ami-id="{{ $user->id }}">
                                                        <i class="icofont icofont-ui-user m-r-10"></i> Unfollow
                                                    </button>
                                                    </form>
                                                </div>
                                            @else
                                                <div class="">
                                                    <form action="">
                                                        @csrf
                                                    <button type="button" class="btn btn-success waves-effect btn-block toggle-button add-friend-btn" data-ami-id="{{$user->id }}">
                                                        <i class="icofont icofont-ui-user m-r-10"></i> Add as Friend
                                                    </button>
                                                </form>
                                                </div>
                                            @endif
                                        @endif

                                        </div>
                                    </div>



                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-header-text d-inline-block">Friends</h5>
                                        </div>
                                        <div class="card-block friend-box">
                                            @if ($user->friends->isEmpty())
                                            <p>No friends yet</p>
                                            @else
                                            @foreach ($user->friends as $friend)
                                            <img class="media-object img-radius" src="{{ asset('storage/avatars') }}/{{ $friend->avatar }}" alt="" data-toggle="tooltip" data-placement="top" title="" data-original-title="user image">
                                           @endforeach
                                           @endif
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="col-xl-9 col-lg-8 col-md-8 col-xs-12 ">

                                <div class="card social-tabs">
                                    <ul class="nav nav-tabs md-tabs tab-timeline" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#timeline" role="tab">Timeline</a>
                                            <div class="slide"></div>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#about" role="tab">About</a>
                                            <div class="slide"></div>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#photos" role="tab">Photos</a>
                                            <div class="slide"></div>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#friends" role="tab">Friends</a>
                                            <div class="slide"></div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="tab-content">

                                    <div class="tab-pane active" id="timeline">
                                        <div class="row">
                                            <div class="col-md-12 timeline-dot">
                                                <div class="social-timelines p-relative">
                                                    <div class="row timeline-right p-t-35">
                                                        <div class="col-2 col-sm-2 col-xl-1">
                                                            <div class="social-timelines-left">
                                                                <img class="img-radius timeline-icon" src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="col-10 col-sm-10 col-xl-11 p-l-5 p-b-35">
                                                            <div class="card">
                                                                @foreach ($posts as $post)
                                                                <div class="card-block post-timelines">
                                                                    <span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>
                                                                    <div class="dropdown-menu dropdown-menu-right b-none services-list">
                                                                        <a class="dropdown-item" href="#">Remove tag</a>
                                                                        <a class="dropdown-item" href="#">Report Photo</a>
                                                                        <a class="dropdown-item" href="#">Hide From Timeline</a>
                                                                        <a class="dropdown-item" href="#">Blog User</a>
                                                                    </div>
                                                                    <div class="chat-header f-w-600">{{ $profile->user->name }}</div>
                                                                    <div class="social-time text-muted">{{ $post->created_at->diffforhumans() }}</div>
                                                                </div>
                                                                <img src="{{ asset('storage/images/' . $post->image) }}" class="img-fluid width-100" alt="">
                                                                <div class="card-block">
                                                                    <div class="timeline-details">
                                                                        <div class="chat-header">{{$profile->user->name  }}</div>
                                                                        <p class="text-muted">{{ $post->content }} </p>
                                                                    </div>
                                                                </div>
                                                                <div class="card-block b-b-theme b-t-theme social-msg">
                                                                    <a href="#"> <i class="icofont icofont-heart-alt text-muted"></i><span class="b-r-muted">Like ({{ $post->likes->count() }})</span> </a>
                                                                    <a href="#"> <i class="icofont icofont-comment text-muted"></i> <span class="b-r-muted">Comments ({{ $post->comments->count() }})</span></a>
                                                                    <a href="#"> <i class="icofont icofont-share text-muted"></i> <span>Share (10)</span></a>
                                                                </div>
                                                                <div class="card-block user-box">
                                                                    <div class="p-b-30"> <span class="f-14"><a href="#">Comments ({{ $post->comments->count() }})</a></span><span class="f-right">see all comments</span></div>
                                                                    @foreach ($post->comments as $comment)
                                                                    <div class="media m-b-20">

                                                                        <a class="media-left" href="#">
                                                                            <img class="media-object img-radius m-r-20" src="{{ asset('storage/avatars') }}/{{ $comment->user->profile->avatar }}" alt="Generic placeholder image">
                                                                        </a>
                                                                        <div class="media-body b-b-muted social-client-description">

                                                                            <div class="chat-header">About {{ $comment->user->name }}<span class="text-muted">{{ $comment->created_at }}</span></div>
                                                                            <p class="text-muted">{{ $comment->comment }}</p>
                                                                        </div>

                                                                    </div>
                                                                    @endforeach

                                                                    <div class="media">
                                                                        <a class="media-left" href="#">
                                                                            <img class="media-object img-radius m-r-20" src="{{ asset('storage/avatars') }}/{{ $profile->avatar }}" alt="Generic placeholder image">
                                                                        </a>
                                                                        <div class="media-body">
                                                                            <form class="">
                                                                                <div class="">
                                                                                    <textarea rows="5" cols="5" class="form-control" placeholder="Write Something here..."></textarea>
                                                                                    <div class="text-right m-t-20"><a href="#" class="btn btn-primary waves-effect waves-light">Post</a></div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                    <div class="tab-pane" id="about">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5 class="card-header-text">Basic Information</h5>
                                                        <button id="edit-btn" type="button" class="btn btn-primary waves-effect waves-light f-right">
                                                            <i class="icofont icofont-edit"></i>
                                                        </button>
                                                    </div>
                                                    <div class="card-block">
                                                        <div id="view-info" class="row">
                                                            <div class="col-lg-6 col-md-12">
                                                                <form>
                                                                    <table class="table table-responsive m-b-0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <th class="social-label b-none p-t-0">Full Name
                                                                                </th>
                                                                                <td class="social-user-name b-none p-t-0 text-muted">{{ $profile->user->name }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th class="social-label b-none">Gender</th>
                                                                                <td class="social-user-name b-none text-muted">{{ $profile->gender }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th class="social-label b-none">Birth Date</th>
                                                                                <td class="social-user-name b-none text-muted">{{ $profile->dob }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th class="social-label b-none">Phone number</th>
                                                                                <td class="social-user-name b-none text-muted">{{ $profile->phone }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th class="social-label b-none p-b-0">Location</th>
                                                                                <td class="social-user-name b-none p-b-0 text-muted">{{ $profile->address }}</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div id="edit-info" class="row" style="display: none;">
                                                            <div class="col-lg-12 col-md-12">
                                                                <form>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" placeholder="Full Name">
                                                                    </div>
                                                                    <div class="input-group">
                                                                        <div class="form-radio">
                                                                            <div class="form-radio">
                                                                                <label class="md-check p-0">Gender</label>
                                                                                <div class="radio radio-inline">
                                                                                    <label>
                                                                                        <input type="radio" name="radio" checked="checked">
                                                                                        <i class="helper"></i>Male
                                                                                    </label>
                                                                                </div>
                                                                                <div class="radio radio-inline">
                                                                                    <label>
                                                                                        <input type="radio" name="radio">
                                                                                        <i class="helper"></i>Female
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="input-group">
                                                                        <input id="dropper-default" class="form-control" type="text" placeholder="Birth Date">
                                                                    </div>
                                                                    <div class="input-group">
                                                                        <select id="hello-single" class="form-control">
                                                                            <option value="">---- Marital Status ----</option>
                                                                            <option value="married">Married</option>
                                                                            <option value="unmarried">Unmarried</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="md-group-add-on">
                                                                        <textarea rows="5" cols="5" class="form-control" placeholder="Address..."></textarea>
                                                                    </div>
                                                                    <div class="text-center m-t-20">
                                                                        <a href="javascript:;" id="edit-save" class="btn btn-primary waves-effect waves-light m-r-20">Save</a>
                                                                        <a href="javascript:;" id="edit-cancel" class="btn btn-default waves-effect waves-light">Cancel</a>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5 class="card-header-text">Contact Information</h5>
                                                        <button id="edit-Contact" type="button" class="btn btn-primary waves-effect waves-light f-right">
                                                            <i class="icofont icofont-edit"></i>
                                                        </button>
                                                    </div>
                                                    <div class="card-block">
                                                        <div id="contact-info" class="row">
                                                            <div class="col-lg-6 col-md-12">
                                                                <table class="table table-responsive m-b-0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <th class="social-label b-none p-t-0">Mobile Number</th>
                                                                            <td class="social-user-name b-none p-t-0 text-muted">{{ $profile->phone }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="social-label b-none">Email Address</th>
                                                                            <td class="social-user-name b-none text-muted">{{ $profile->user->email }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="social-label b-none">Twitter</th>
                                                                            <td class="social-user-name b-none text-muted">@phonixcoded</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="social-label b-none p-b-0">Skype</th>
                                                                            <td class="social-user-name b-none p-b-0 text-muted">@phonixcoded demo</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div id="edit-contact-info" class="row" style="display: none;">
                                                            <div class="col-lg-12 col-md-12">
                                                                <form>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" placeholder="Mobile number">
                                                                    </div>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" placeholder="Email address">
                                                                    </div>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" placeholder="Twitter id">
                                                                    </div>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" placeholder="Skype id">
                                                                    </div>
                                                                    <div class="text-center m-t-20">
                                                                        <a href="javascript:;" id="contact-save" class="btn btn-primary waves-effect waves-light m-r-20">Save</a>
                                                                        <a href="javascript:;" id="contact-cancel" class="btn btn-default waves-effect waves-light">Cancel</a>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5 class="card-header-text">Biographie</h5>
                                                        <button id="edit-work" type="button" class="btn btn-primary waves-effect waves-light f-right">
                                                            <i class="icofont icofont-edit"></i>
                                                        </button>
                                                    </div>
                                                    <div class="card-block">
                                                        <div id="work-info" class="row">
                                                            <div class="col-lg-6 col-md-12">
                                                                <table class="table table-responsive m-b-0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <th class="social-label b-none p-t-0">Little description about me
                                                                            </th>
                                                                            <td class="social-user-name b-none p-t-0 text-muted">{{ $profile->biographie }}</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div id="edit-contact-work" class="row" style="display: none;">
                                                            <div class="col-lg-12 col-md-12">
                                                                <form>
                                                                    <div class="input-group">
                                                                        <select id="occupation" class="form-control">
                                                                            <option value=""> Select occupation </option>
                                                                            <option value="married">Developer</option>
                                                                            <option value="unmarried">Web Design</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="input-group">
                                                                        <select id="skill" class="form-control">
                                                                            <option value=""> Select Skills </option>
                                                                            <option value="married">C# &amp; .net</option>
                                                                            <option value="unmarried">Angular</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="input-group">
                                                                        <select id="job" class="form-control">
                                                                            <option value=""> Select Job </option>
                                                                            <option value="married">#</option>
                                                                            <option value="unmarried">Other</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="text-center m-t-20">
                                                                        <a href="javascript:;" id="work-save" class="btn btn-primary waves-effect waves-light m-r-20">Save</a>
                                                                        <a href="javascript:;" id="work-cancel" class="btn btn-default waves-effect waves-light">Cancel</a>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="photos">
                                        <div class="card">

                                            <div class="card-block">
                                                <div class="demo-gallery">
                                                    @foreach($posts as $post)
                                                    <ul id="profile-lightgallery" class="row">

                                                        <li class="col-md-4 col-lg-2 col-sm-6 col-xs-12">
                                                            <a href="#" data-toggle="lightbox" data-title="A random title" data-footer="A custom footer text">
                                                                <img src="{{ asset('storage/images') }}/{{ $post->image }}" class="img-fluid" alt="">
                                                            </a>
                                                        </li>

                                                    </ul>
                                                    @endforeach
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="tab-pane" id="friends">
                                        <div class="row">
                                            @foreach ($user->friends as $friend)
                                            <div class="col-lg-12 col-xl-6">

                                                <div class="card">

                                                    <div class="card-block post-timelines">
                                                        <span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>
                                                        <div class="dropdown-menu dropdown-menu-right b-none services-list">
                                                            <a class="dropdown-item" href="#">Remove tag</a>
                                                            <a class="dropdown-item" href="#">Report Photo</a>
                                                            <a class="dropdown-item" href="#">Hide From Timeline</a>
                                                            <a class="dropdown-item" href="#">Blog User</a>
                                                        </div>
                                                        <div class="media bg-white d-flex">
                                                            <div class="media-left media-middle">
                                                                <a href="#">
                                                                    <img class="media-object" width="120" src="{{ asset('storage/avatars') }}/{{ $friend->avatar }}" alt="">
                                                                </a>
                                                            </div>
                                                            <div class="media-body friend-elipsis">
                                                                <div class="f-15 f-bold m-b-5">{{ $friend->name }}</div>
                                                                <div class="text-muted social-designation">{{ $friend->profile->address }}</div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                            @endforeach
                                        </div>
                                    </div>


@endsection
