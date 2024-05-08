@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">My Friends</div>
                <div class="card-body">
                    @if ($friends->count() > 0)
                        <ul class="list-group">
                            @foreach ($friends as $friend)
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        @if ($friend->profile)
                                            <img src="{{ asset('storage/avatars') }}/{{ $friend->profile->avatar }}" alt="User Avatar" class="avatar">
                                        @else
                                            <img src="{{ asset('images/default-avatar.png') }}" alt="Default Avatar" class="avatar">
                                        @endif
                                        <span class="ml-2">{{ $friend->name }}</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>You have no friends yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
