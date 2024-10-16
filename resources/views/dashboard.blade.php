@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2">Dashboard</h1>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-primary shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Total Posts</h5>
                    <p class="card-text display-4">{{ $totalPosts }}</p>
                    <a href="{{ route('posts.index') }}" class="btn btn-light">View Posts</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card text-white bg-success shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Published Posts</h5>
                    <p class="card-text display-4">{{ $publishedPosts }}</p>
                    <a href="{{ route('posts.index') }}?filter=published" class="btn btn-light">View Published</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card text-white bg-warning shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Draft Posts</h5>
                    <p class="card-text display-4">{{ $draftPosts }}</p>
                    <a href="{{ route('posts.index') }}?filter=draft" class="btn btn-light">View Drafts</a>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded shadow-sm p-4 mt-4">
        <h4 class="font-semibold">Latest Posts:</h4>
        @if($latestPosts->count() > 0)
            <ul class="list-unstyled">
                @foreach($latestPosts as $post)
                    <li class="border-bottom py-2">
                        <a href="{{ route('posts.show', $post->id) }}" class="text-blue-600 hover:underline">
                            {{ $post->title }}
                        </a>
                        <span class="text-muted"> ({{ $post->created_at->diffForHumans() }})</span>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500">No recent posts available.</p>
        @endif
    </div>
</div>
@endsection
