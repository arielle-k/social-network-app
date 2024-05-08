@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->name }}</h5>
                        <p class="card-text">{{ $post->content }}</p>
                        @if ($post->image)
                            <img src="{{ asset('storage/images/' . $post->image) }}" alt="Post Image" class="img-fluid" width="200">
                        @endif
                        <div class="mt-3">
                            <strong>{{ $post->likes->count() }}</strong> likes
                        </div>
                        <div class="mt-3">
                            <form action="" method="POST">
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <div class="form-group">
                                    <textarea name="content" rows="2" class="form-control" placeholder="Add a comment"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="card-title">Comments</h5>
                        @foreach ($post->comments as $comment)
                            <div class="media mt-4">
                                <img src="{{ asset('storage/avatars/' . $comment->user->profile->avatar) }}" alt="User Image" class="mr-3 rounded-circle" width="50">
                                <div class="media-body">
                                    <h6 class="mt-0">{{ $comment->user->name }}</h6>
                                    <p>{{ $comment->comment }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


