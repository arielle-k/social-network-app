@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="people-nearby">
                    @foreach ($users as $user)
                  <div class="nearby-user">
                    <div class="row">
                      <div class="col-md-2 col-sm-2">
                        <img src="{{ asset('storage/avatars') }}/{{ $user->profile->avatar }}" alt="user" class="profile-photo-lg img-thumbnail rounded-circle">

                      </div>
                      <div class="col-md-7 col-sm-7">
                        <h5><a href="{{ route('profile.show',$user->profile->id) }}" class="profile-link text-decoration-none">{{ $user->name }}</a></h5>
                        <p>{{ $user->profile->gender }}</p>
                        <p class="text-muted">{{ $user->profile->address }}</p>
                      </div>
                      <div class="col-md-3 col-sm-3">
                        <form action="">
                        @csrf
                        <button class="btn btn-success pull-right toggle-button add-friend-btn" data-ami-id="{{$user->id }}">Add Friend</button>
                       </form>
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
