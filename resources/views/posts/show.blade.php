@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <a href="{{ route('profile.show', $post->user) }}" class="font-weight-bold text-dark">
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
                    <!-- Similar to the post section in index.blade.php -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
