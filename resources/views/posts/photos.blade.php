@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center p-3  m-2 bg-info" style="background-color: paleturquoise"> My Galeries</h1>

        <div class="row">
            @if($photos->count()==0)
            <P CLASS="text-center m-3 p-2 text-warning" style="background-color: rgb(137, 172, 249)">no photos yet! create post to see your photos</h3>
                <a href="{{ route('posts.create') }}" class="btn btn-primary" style="background-color: pink">create new post</a>
            @endif
            @foreach ($photos as $photo)
                <div class="col-md-3">
                    <img src="{{asset('storage/images')}}/{{$photo->image}}" alt="Photo" class="img-fluid">
                </div>
            @endforeach
        </div>
    </div>
@endsection
