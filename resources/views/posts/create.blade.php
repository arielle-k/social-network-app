@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header" style="background-color: paleturquoise">
            <h1 style="font-family:'Times New Roman', Times, serif ; " class="text-center">Add new Post</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('posts.store') }}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="row">
                    <div class="col-8 offset-2">
                        <div class="form-group row">
                            <label for="caption" class="col-md-4 col-form-label">Post Name</label>
                            <input id="caption" type="text" maxlength="100"
                                   class="form-control @error('caption') is-invalid @enderror" name="name" value="{{ old('caption') }}"  autocomplete="caption" autofocus>
                            @error('caption')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="desc" class="col-md-4 col-form-label">Post Content</label>
                            <textarea id="desc" type="text" style="max-height: 220px; min-height: 70px" maxlength="150"
                                      class="form-control @error('desc') is-invalid @enderror" name="content"  autocomplete="desc" autofocus>
                            </textarea>
                            @error('desc')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label">Post Image</label>
                            <input type="file" class="form-control-file" id="image" name="image">
                            @error('image')
                                <strong>{{ $message }}</strong>
                            @enderror
                        </div>

                        <div class="row pt-4">
                            <button class=" text-dark " style="width: 100px; background-color:palevioletred">Post it</button>
                            <a href="{{ route('posts.index') }}" class="btn btn-outline-danger ml-2">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
