@extends('layouts.app')

@section('content')


<div class="container bootstrap snippets bootdey">
    <hr>
    <ol class="breadcrumb">
        <li><a href="#">Page name for <span style="font-family: Verdana, Geneva, Tahoma, sans-serif ;font-style:italic">"{{ $query }}" </span></a></li>
        <li><a href="#">Search Results</a></li>
        <li class="pull-right"><a href="" class="text-muted"><i class="fa fa-refresh"></i></a></li>
    </ol>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="well search-result my-3">
                <form action="{{ route('users.search') }}" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search" name="query">
                    <span class="input-group-btn">
                <button class="btn btn-info btn-lg" type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search-heart-fill" viewBox="0 0 16 16">
                    <path d="M6.5 13a6.474 6.474 0 0 0 3.845-1.258h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.008 1.008 0 0 0-.115-.1A6.471 6.471 0 0 0 13 6.5 6.502 6.502 0 0 0 6.5 0a6.5 6.5 0 1 0 0 13Zm0-8.518c1.664-1.673 5.825 1.254 0 5.018-5.825-3.764-1.664-6.69 0-5.018Z"/>
                  </svg>
                        Search
                    </button>

                </span>
                </div>
            </form>
            </div>
            <div class="well search-result">
                @foreach ($users as $user)
                <div class="row">
                    <a href="{{ route('profile.show', $user->profile) }}" class="text-decoration-none">
                        <div class="col-xs-6 col-sm-3 col-md-3 col-lg-2">
                            <img class="img-responsive" src="{{ asset('storage/avatars') }}/{{ $user->profile->avatar }}" alt="" class="img-thumbnail" width="100">
                        </div>
                        <div class="col-xs-6 col-sm-9 col-md-9 col-lg-10 title">
                            <h3>{{ $user->name }}</h3>
                            <p>{{ $user->profile->biographie }}</p>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>


        </div>
    </div>
</div>



@endsection
