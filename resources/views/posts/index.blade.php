@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach($posts as $post)
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <a href="{{ route('users.show', $post->user) }}" class="font-weight-bold text-dark">
                            {{ $post->user->name }}
                        </a>
                        @if($post->user->id === auth()->id())
                            <form action="{{ route('posts.destroy', $post) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        @endif
                    </div>
                    <div class="card-body p-0">
                        <img src="{{ asset('storage/' . $post->image) }}" class="w-100">
                    </div>
                    <div class="card-footer">
                        <div class="d-flex align-items-center mb-2">
                            @auth
                                @if(!$post->likedBy(auth()->user()))
                                    <form action="{{ route('likes.store', $post) }}" method="POST" class="mr-1">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-link p-0">
                                            <i class="far fa-heart fa-lg"></i>
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('likes.destroy', $post) }}" method="POST" class="mr-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-link p-0">
                                            <i class="fas fa-heart fa-lg text-danger"></i>
                                        </button>
                                    </form>
                                @endif
                            @endauth
                            <span class="font-weight-bold">
                                {{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}
                            </span>
                        </div>

                        <p>
                            <span class="font-weight-bold">
                                <a href="{{ route('users.show', $post->user) }}" class="text-dark">
                                    {{ $post->user->name }}
                                </a>
                            </span>
                            {{ $post->caption }}
                        </p>

                        @foreach($post->comments as $comment)
                            <p class="mb-1">
                                <span class="font-weight-bold">
                                    <a href="{{ route('users.show', $comment->user) }}" class="text-dark">
                                        {{ $comment->user->name }}
                                    </a>
                                </span>
                                {{ $comment->content }}

                                @if($comment->user->id === auth()->id())
                                    <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-link p-0">
                                            <i class="fas fa-trash text-danger"></i>
                                        </button>
                                    </form>
                                @endif
                            </p>
                        @endforeach

                        @auth
                            <form action="{{ route('comments.store', $post) }}" method="POST">
                                @csrf
                                <div class="input-group">
                                    <input type="text" name="content" class="form-control" placeholder="Add a comment...">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary">Post</button>
                                    </div>
                                </div>
                            </form>
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
