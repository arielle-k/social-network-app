@extends('layouts.app')

@section('content')
@if(session('error'))
<div class="alert alert-warning my-3">{{ session('error') }}</div>
@endif
<div class="container">
    <div class="friend-list row">
        @foreach ($friends as $friend)
        <div class="col-md-4 col-sm-6">
            <div class="friend-card mt-3">
                <div class="card-info">
                    @if ($friend->profile && $friend->profile->avatar)
                        <img src="{{ asset('storage/avatars/'.$friend->profile->avatar) }}" alt="user" class="profile-photo-lg img-thumbnail friend-image">
                    @else
                        <!-- Affiche une image par défaut ou un espace vide si l'ami n'a pas de profil -->
                        <img src="{{ asset('images/avatar.png') }}" alt="user" class="profile-photo-lg img-thumbnail friend-image">
                    @endif
                    <div class="friend-info">
                        <h5><a href="{{ $friend->profile ? route('profile.show', $friend->profile->id) : '#' }}" class="profile-link text-decoration-none">{{ $friend->name }}</a></h5>

                        <p>Friends since: {{ $friend->created_at->diffForHumans() }}</p>
                        <p>Gender: {{$friend->profile->gender }}</p>
                        <p>Address: {{ $friend->profile->address }}</p>
                        <div>
                            <form action="" method="post">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger toggle-button" data-ami-id="{{ $friend->id }}">Unfollow</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
