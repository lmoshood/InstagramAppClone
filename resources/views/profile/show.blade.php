@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center mb-5">
                <div class="mr-5">
                    @if($user->profile_photo_path)
                        <img src="{{ asset('storage/' . $user->profile_photo_path) }}" class="rounded-circle" width="150" height="150">
                    @else
                        <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center" style="width: 150px; height: 150px;">
                            <i class="fas fa-user fa-3x text-white"></i>
                        </div>
                    @endif
                </div>
                <div>
                    <div class="d-flex align-items-center mb-3">
                        <h2 class="mb-0 mr-3">{{ $user->username ?? $user->name }}</h2>
                        @if($isCurrentUser)
                            <a href="#" class="btn btn-outline-secondary btn-sm">Edit Profile</a>
                        @else
                            <button class="btn btn-primary btn-sm">Follow</button>
                        @endif
                    </div>
                    <div class="d-flex mb-3">
                        <div class="mr-3"><strong>{{ $user->posts->count() }}</strong> posts</div>
                        <div class="mr-3"><strong>0</strong> followers</div>
                        <div class="mr-3"><strong>0</strong> following</div>
                    </div>
                    <div>
                        <h5>{{ $user->name }}</h5>
                        <p>{{ $user->bio ?? 'No bio yet.' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach($posts as $post)
            <div class="col-4 mb-4">
                <a href="{{ route('posts.show', $post) }}">
                    <div class="square-image-container">
                        <img src="{{ asset('storage/' . $post->image) }}" class="w-100 square-image">
                        <div class="square-image-overlay d-flex align-items-center justify-content-center">
                            <div class="text-white text-center">
                                <div><i class="fas fa-heart"></i> {{ $post->likes_count }}</div>
                                <div><i class="fas fa-comment"></i> {{ $post->comments_count }}</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>

<style>
    .square-image-container {
        position: relative;
        width: 100%;
        padding-bottom: 100%; /* 1:1 Aspect Ratio */
        overflow: hidden;
    }

    .square-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .square-image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.3);
        opacity: 0;
        transition: opacity 0.3s;
    }

    .square-image-container:hover .square-image-overlay {
        opacity: 1;
    }
</style>
@endsection
