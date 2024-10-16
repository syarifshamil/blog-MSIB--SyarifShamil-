@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">{{ $post->title }}</h1>

        <div class="text-muted mb-2">
            <small>Published on {{ $post->created_at->format('F j, Y') }}</small>
        </div>

        <div class="mb-4">
            <strong>Content:</strong>
            <p>{{ $post->content }}</p>
        </div>

        <div class="mb-4">
            <strong>Category:</strong>
            <span class="badge bg-primary">{{ $post->category->name }}</span>
        </div>

        <div class="mb-4">
            <strong>Published:</strong>
            <span class="badge {{ $post->is_published ? 'bg-success' : 'bg-danger' }}">
                {{ $post->is_published ? 'Yes' : 'No' }}
            </span>
        </div>

        @if ($post->image)
            <div class="mb-4">
                <strong>Image:</strong>
                <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="img-fluid" style="max-width: 600px;">
            </div>
        @endif

        <div class="mt-4">
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back to Posts</a>
        </div>
    </div>
@endsection
