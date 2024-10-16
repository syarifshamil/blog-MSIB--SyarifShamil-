@extends('layouts.app')

@section('title', 'Posts')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2">Posts</h1>
        <a href="{{ route('posts.create') }}" class="btn btn-primary">Create New Post</a>
    </div>

    {{-- Form Filter --}}
    <form method="GET" action="{{ route('posts.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Search by title" value="{{ request()->get('search') }}">
            </div>
            <div class="col-md-4">
                <select name="category_id" class="form-control">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request()->get('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    @if ($posts->count() > 0)
        <div class="list-group">
            @foreach ($posts as $post)
                <div class="list-group-item d-flex justify-content-between align-items-center shadow-sm mb-3 p-3 rounded">
                    <div class="d-flex">
                        {{-- Thumbnail Image --}}
                        @if ($post->image)
                            <img src="{{ asset('storage/'.$post->image) }}" alt="Post image" class="img-thumbnail me-3" style="width: 100px; height: 100px; object-fit: cover;">
                        @else
                            <img src="https://via.placeholder.com/100" alt="Default Image" class="img-thumbnail me-3" style="width: 100px; height: 100px; object-fit: cover;">
                        @endif

                        {{-- Post Details --}}
                        <div>
                            <h5 class="mb-1">
                                <a href="{{ route('posts.show', $post->id) }}" class="text-decoration-none">{{ $post->title }}</a>
                            </h5>
                            <p class="mb-1 text-muted">Category: {{ $post->category->name }}</p>
                            <p class="mb-0">
                                <span class="badge {{ $post->is_published ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $post->is_published ? 'Published' : 'Draft' }}
                                </span>
                            </p>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="align-self-center">
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-warning me-2">Edit</a>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure want to delete this post?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination (if applicable) --}}
        <div class="mt-4">
            {{ $posts->links() }} {{-- Assuming you're using Laravel pagination --}}
        </div>
    @else
        <div class="alert alert-info" role="alert">
            No posts available at the moment.
        </div>
    @endif
</div>
@endsection
