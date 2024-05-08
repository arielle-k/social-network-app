@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Your last posts</h2>
        <div class="row">
            @foreach ($posts as $post)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-img-top" style="height: 200px; background-image: url('{{ asset('storage/images/' . $post->image) }}'); background-size: cover; background-position: center;"></div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->name }}</h5>
                            <p class="card-text">{{ $post->content }}</p>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary">Edit</a>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $post->id }}">Delete</button>
                        </div>
                        <!-- Modal de confirmation de suppression -->
                        <div class="modal fade" id="deleteModal{{ $post->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $post->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $post->id }}">Confirm Deletion</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete this post?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display: inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <hr class="section-divider">

        <div class="user-comments">
            <div class="row mt-4">
                <div class="col-lg-12 ps-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <h4 class="card-title">Latest Comments</h4>
                        </div>
                        <div class="comment-widgets">
                            @foreach ($userComments as $comment)
                                @if ($comment->post)
                                    <div class="d-flex flex-row comment-row m-t-0">
                                        <div class="p-2">
                                            <a href="{{ route('profile.show', $comment->post->user->profile) }}">
                                                <img src="{{ asset('storage/avatars') }}/{{ $comment->post->user->profile->avatar }}" alt="Post Image" width="50" class="rounded-circle">
                                            </a>
                                        </div>
                                        <div class="comment-text w-100">
                                            <h6 class="font-medium">{{ $comment->post->user->name }}</h6>
                                            <span class="m-b-15 d-block">{{ $comment->comment }}</span>
                                            <div class="comment-footer">
                                                <span class="text-muted float-right">{{ $comment->created_at->diffForHumans() }}</span>
                                                <button type="button" class="btn btn-warning btn-sm" onclick="showCommentEditForm({{ $comment->id }})">Edit</button>
                                                <form id="delete-form-{{ $comment->id }}" action="{{ route('comments.destroy', $comment) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="confirmDelete(event, {{ $comment->id }})">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr class="section-divider">

        <div class="user-likes">
            <h3>Liked Posts</h3>
            <div class="row">
                @foreach ($userLikes as $like)
                    @if ($like->post)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-img-top" style="height: 200px; background-image: url('{{ asset('storage/images/' . $like->post->image) }}'); background-size: cover; background-position: center;"></div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $like->post->name }}</h5>
                                    <p class="card-text">{{ $like->post->content }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(event, commentId) {
            event.preventDefault();
            if (confirm('Are you sure you want to delete this comment?')) {
                document.getElementById('delete-form-' + commentId).submit();
            }
        }
    </script>
@endsection
