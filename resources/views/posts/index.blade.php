@extends('layouts.app')

@section('content')

<div class="container">
    <div class="profile-page tx-13">
        <div class="row mt-5">
            <div class="col-12 grid-margin">
                <div class="profile-header">
                    <div class="cover">
                        <div class="gray-shade"></div>
                        <figure>
                            <img src="https://bootdey.com/img/Content/bg1.jpg"  alt="profile cover" height="100">
                        </figure>
                        <div class="cover-body d-flex justify-content-between align-items-center">
                            <div>
                                @if ($profile)
                                <img class="profile-pic" src="{{ asset('storage/avatars') }}/{{ $profile->avatar }}" alt="profile">
                                <span class="profile-name">{{ $profile->user->name }}</span>
                                @else
                                <img class="img-circle img-sm" src="{{ asset('storage/avatars/default.png') }}" alt="Default Avatar">
                                <span class="profile-name">{{ auth()->user()->name }}</span>
                                @endif

                            </div>
                            <div class="d-none d-md-block">
                                    <form action="{{ route('users.search') }}" method="GET" class="search-form">
                                        <div class="input-group">
                                            <input type="text" name="query" class="form-control" placeholder="Search the users" aria-label="Rechercher">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                                                        <circle cx="11" cy="11" r="8"></circle>
                                                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                            </div>
                        </div>
                    </div>
                    <div class="header-links">
                        <ul class="links d-flex align-items-center mt-3 mt-md-0">
                            <li class="header-link-item d-flex align-items-center active">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-columns mr-1 icon-md">
                                    <path d="M12 3h7a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-7m0-18H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h7m0-18v18"></path>
                                </svg>
                                <a class="pt-1px d-none d-md-block text-decoration-none" href="#">Timeline</a>
                            </li>
                            <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user mr-1 icon-md">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <a class="pt-1px d-none d-md-block text-decoration-none" href="{{ route('user.activities',Auth::user()->id) }}">Activities</a>
                            </li>
                            <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users mr-1 icon-md">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                                <a class="pt-1px d-none d-md-block text-decoration-none" href="{{ route('user.friends') }}">Friends <span class="text-muted tx-12">{{ $friendsCount }}</span></a>
                            </li>
                            <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image mr-1 icon-md">
                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                    <polyline points="21 15 16 10 5 21"></polyline>
                                </svg>
                                <a class="pt-1px d-none d-md-block text-decoration-none" href="{{ route('user.photos') }}">Photos</a>
                            </li>
                            <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square">
                                    <path d="M3 3h18v18H3zM7 7h10M7 11h8M7 15h6" />
                                  </svg>
                                <a class="pt-1px d-none d-md-block text-decoration-none" href="{{ route('chatify') }}" >Messages</a>
                              </li>

                            <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
                                <span class="notification-count">{{ $unreadNotificationsCount }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell mr-1 icon-md">
                                    <path d="M18.74 17.2C18.74 16.28 19.63 15.8 20.52 14.86C21.24 14.12 21.24 13.03 20.52 12.29C18.81 10.54 17.92 9.41 17.92 6.72C17.92 3.04 15.12 0 11.5 0C7.88 0 5.08 3.04 5.08 6.72C5.08 9.41 4.19 10.54 2.48 12.29C1.76 13.03 1.76 14.12 2.48 14.86C3.38 15.8 4.28 16.28 4.28 17.2C4.28 18.74 2.96 20 1.34 20C0.6 20 0 20.6 0 21.34C0 21.89 0.45 22.34 1 22.34H21C21.55 22.34 22 21.89 22 21.34C22 20.6 21.4 20 20.66 20C19.04 20 17.72 18.74 17.72 17.2H18.74Z"></path>
                                    <circle cx="16" cy="8" r="3" fill="red"></circle>
                                    <path d="M11.5 24C13.43 24 15 22.43 15 20.5H8C8 22.43 9.57 24 11.5 24Z"></path>
                                </svg>
                                <a class="pt-1px d-none d-md-block text-decoration-none" href="https://mailtrap.io/inboxes/1820399/messages" target="_blank">Notifications</a>

                            </li>
                    </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row profile-body">
            <!-- left wrapper start -->
            <div class="d-none d-md-block col-md-4 col-xl-3 left-wrapper">
                <div class="card rounded">
                    @if($profile)
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-2">

                            <h6 class="card-title mb-0">About</h6>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal icon-lg text-muted pb-3px">
                                        <circle cx="12" cy="12" r="1"></circle>
                                        <circle cx="19" cy="12" r="1"></circle>
                                        <circle cx="5" cy="12" r="1"></circle>
                                    </svg>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                    <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.edit',$profile) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 icon-sm mr-2">
                                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                        </svg> <span class="">Edit</span></a>

                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-git-branch icon-sm mr-2">
                                            <line x1="6" y1="3" x2="6" y2="15"></line>
                                            <circle cx="18" cy="6" r="3"></circle>
                                            <circle cx="6" cy="18" r="3"></circle>
                                            <path d="M18 9a9 9 0 0 1-9 9"></path>
                                        </svg> <span class="">Update</span></a>
                                    <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.show',$profile->id) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye icon-sm mr-2">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg> <span class="">View all</span></a>
                                </div>
                            </div>

                        </div>
                        <p>{{ $profile->biographie }}</p>
                        <div class="mt-3">
                            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Joined:</label>
                            <p class="text-muted">{{ $profile->created_at }}</p>
                        </div>
                        <div class="mt-3">
                            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Lives:</label>
                            <p class="text-muted">{{ $profile->address }}</p>
                        </div>
                        <div class="mt-3">
                            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Email:</label>
                            <p class="text-muted">{{ auth()->user()->email }}</p>
                        </div>
                        <div class="mt-3">
                            <label class="tx-11 font-weight-bold mb-0 text-uppercase">birthday</label>
                            <p class="text-muted">{{ $profile->dob }}</p>
                        </div>
                        <div class="mt-3 d-flex social-links">
                            <a href="javascript:;" class="btn d-flex align-items-center justify-content-center border mr-2 btn-icon github">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-github" data-toggle="tooltip" title="" data-original-title="github.com/nobleui">
                                    <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path>
                                </svg>
                            </a>
                            <a href="javascript:;" class="btn d-flex align-items-center justify-content-center border mr-2 btn-icon twitter">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter" data-toggle="tooltip" title="" data-original-title="twitter.com/nobleui">
                                    <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>
                                </svg>
                            </a>
                            <a href="javascript:;" class="btn d-flex align-items-center justify-content-center border mr-2 btn-icon instagram">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram" data-toggle="tooltip" title="" data-original-title="instagram.com/nobleui">
                                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                </svg>
                            </a>
                        </div>
                    </div>
                    @else
                    <div class="card-body">
                        <h6 class="card-title text-danger">Please complete your profile</h6>
                        <p>Share more information with the community by completing your profile.</p>
                        <a href="{{ route('profile.create') }}" class="btn btn-info ">Complete your  profile</a>
                    </div>
                    @endif
                </div>
            </div>
            <!-- left wrapper end -->
            <!-- middle wrapper start -->
            <div class="col-md-4 col-xl-6 middle-wrapper">
                @if ($friendsCount == 0)
                <div class="alert alert-success h5 text-center">Hello !<span style="font-family: Lucida Handwriting">{{ auth()->user()->name }}</span> welcome to <span style="color: pink; font-style:italic"><b>Share</b>Zone</span></div>
                <div class="default-video">
                    <video width="500" height="480" controls autoplay muted>
                        <source src="{{ asset('storage/videos/default-video.mp4') }}" type="video/mp4">
                        <img src="{{ asset('images/ShareZone.png') }}" alt="Video Preview" poster>
                    </video>

                </div>
            @endif
                <div class="row">
                    <div class="justify-content-center offset-5 my-3 me-3" id="create-button-post" data-tilt data-tilt-reverse="true" data-tilt-axis="x" data-tilt-scale="1.2" data-tilt-max="15" data-tilt-glare data-tilt-max-glare="0.9"  data-tilt-easing="cubic-bezier(.03,.98,.52,.99)" data-tilt-reverse="true">
                        <a href="{{ route('posts.create') }}" class="text-decoration-none ps-2">Add new post</a>
                    </div>
                    @foreach ($posts as $post)
                    <div class="container bootstrap snippets bootdey">
                        <div class="col-md-12">
                          <div class="box box-widget">
                            <div class="box-header with-border">
                              <div class="user-block">
                                @if ($post->user->profile)
                                <img class="img-circle" src=" {{ asset('storage/avatars') }}/{{ $post->user->profile->avatar }}" alt="User Image">
                                @else
                                <img class="img-circle" src="{{ asset('storage/avatars/default.png') }}" alt="User Image">
                                @endif
                                <span class="username"><a href="{{ route('profile.show', ['profile' => $post->user->profile->id]) }}">{{ $post->user->name }}</a></span>
                                <span class="description">Shared publicly - {{$post->created_at->diffForHumans()}}</span>
                              </div>
                              <div class="box-tools">
                                <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read">
                                <i class="fa fa-circle-o"></i></button>
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                              </div>
                            </div>

                            <div class="box-body" style="display: block;">
                                <img class="img-fluid img-thumbnail" src=" {{ asset('storage/images')}}/{{ $post->image }}" alt="Photo">
                                <p>{{ $post->content }}</p>
                                <form action="{{ route('posts.like') }}" id="form-js">
                                    <input type="hidden" name="" id="post-id-js" value={{ $post->id }}>
                                    <button type="submit" class="btn btn-default btn-xs btn-like-active">
                                    <i class="fa fa-thumbs-o-up"></i> Like
                                    </button>
                                    <span class="pull-right text-muted" id="count-js">{{ $post->likes->count() }} likes </span>
                                </form>
                               <span>{{ $post->comments->count() }} comments</span>
                            </div>
                            <div class="box-footer box-comments " style="display: block;" id="comment-list-{{ $post->id }}">
                                @foreach ($post->comments as $comment)
                              <div class="box-comment ">
                                @if($profile)
                                <img class="img-circle img-sm" src="{{ asset('storage/avatars') }}/{{ $comment->user->profile->avatar }}" alt="User Image">
                                @else
                                <img class="img-circle img-sm" src="{{ asset('storage/avatars/default.png') }}" alt="User Image">
                                 @endif
                                <div class="comment-text">
                                  <span class="username">
                                    {{ $comment->user->name }}
                                  <span class="text-muted pull-right">{{ $comment->created_at }}</span>
                                  </span>
                                  <p id="comment-list">{{ $comment->comment }} </p>
                                </div>
                              </div>
                              @endforeach
                            </div>
                            <div class="box-footer " style="display: block;">
                                <div class="box-footer">
                                    <form action="{{ route('comments.store') }}" method="post" id="comment-form-{{ $post->id }}">
                                        @csrf
                                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                                        <img class="img-fluid img-circle img-sm" src="{{ asset('storage/avatars') }}/{{ $profile->avatar }}" alt="Alt Text" height="50">
                                        <div class="img-push">
                                            <div class="input-group">
                                                <input type="text" class="form-control input-sm comment-input" id="comment-input-{{ $post->id }}" placeholder="Press enter to post comment" name="comment">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-dark" type="submit" onclick="addComment(event, {{ $post->id }})"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
                                                        <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/>
                                                      </svg></button>

                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                          </div>
                        </div>
                        </div>
                        @endforeach
                </div>
            </div>
            <!-- middle wrapper end -->
            <!-- right wrapper start -->
            <div class="d-none d-xl-block col-md-4 col-xl-3 right-wrapper">
                <div class="row">
                    <div class="col-md-12 grid-margin">
                        <div class="card rounded">
                            <div class="card-body">
                                <h6 class="card-title">latest photos</h6>
                                @if ($photos->count() > 0)
                                <div class="latest-photos">
                                    <div class="row">
                                        <div class="col-md-4 pffset-3">
                                            @foreach ($photos as $photo )
                                            <figure>
                                                <img class="img-fluid" src="{{asset('storage/images')}}/{{$photo->image}}" alt="" class="img-fluid img-thumbnail">
                                            </figure>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @else
                                <p>Your last photos will be displayed here.</p>
                             @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 grid-margin">
                        <div class="card rounded">
                            <div class="card-body">
                                <h6 class="card-title">suggestions for you</h6>
                    @if (auth()->user()->profile)
                  @foreach ($friendsSuggestions as $friendSuggestion)
            <!-- Afficher les détails de chaque suggestion d'ami -->
            <div class="d-flex justify-content-between mb-2 pb-2 border-bottom">
                <div class="d-flex align-items-center hover-pointer">
                    <img class="img-xs rounded-circle" src="{{ asset('storage/avatars') }}/{{ $friendSuggestion->profile->avatar }}" alt="">
                    <div class="ml-2">
                        <p>{{ $friendSuggestion->name }}</p>
                        <p class="tx-11 text-muted">Mutual Friends</p>
                    </div>
                </div>
                <button class="btn btn-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus" data-toggle="tooltip" title="" data-original-title="Connect">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="8.5" cy="7" r="4"></circle>
                        <line x1="20" y1="8" x2="20" y2="14"></line>
                        <line x1="23" y1="11" x2="17" y2="11"></line>
                    </svg>
                </button>
            </div>
                @endforeach
                <form action="{{ route('add.friends') }}" method="get">
                    @csrf
                    <button type="submit" class="btn btn-primary">Connect with More users</button>
                </form>
            @else
        <p class="text-danger">No friend suggestions available. Connect with more users to see suggestions.</p>
        <form action="{{ route('add.friends') }}" method="get">
        @csrf
        <button type="submit" class="btn btn-primary">Connect with Users</button>
    </form>
    @endif
          </div>
             </div>
                    </div>
                </div>
            </div>
            <!-- right wrapper end -->
        </div>
    </div>
    </div>

@endsection

<script>
    function addComment(event, postId) {
        event.preventDefault();
        var commentInput = document.getElementById('comment-input-' + postId);
        var comment = commentInput.value;

        // Envoi de la requête AJAX
        fetch('{{ route("comments.store") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                post_id: postId,
                comment: comment
            })
        })
        .then(response => response.json())
        .then(data => {
            // Vider le champ de commentaire après l'ajout
            commentInput.value = '';

            // Mettre à jour la liste des commentaires
            var commentList = document.getElementById('comment-list-' + postId);
            commentList.innerHTML += `
                <div class="box-comment">
                    <img class="img-circle img-sm" src="{{ asset('storage/avatars') }}/${data.avatar}" alt="User Image">
                    <div class="comment-text">
                        <span class="username">${data.username}</span>
                        <span class="text-muted pull-right">${data.created_at}</span>
                        <p>${data.comment}</p>
                    </div>
                </div>
            `;
        })
        .catch(error => console.error(error));
    }
</script>
