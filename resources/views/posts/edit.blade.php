{{-- resources/views/posts/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
<div class="container mt-4">
    <h2 class="text-3xl font-semibold mb-4">Edit {{ $post->title }}</h2>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data" class="bg-light p-4 rounded shadow">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $post->title) }}" required>
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea name="content" id="content" class="form-control" required>{{ old('content', $post->content) }}</textarea>
            @error('content')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select name="category_id" id="category_id" class="form-select" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $post->category_id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" id="image" class="form-control">
            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            @if ($post->image)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $post->image) }}" alt="Current image" style="width: 150px; height: auto;">
                </div>
            @endif
        </div>

        {{-- Tombol Publish dan Draft --}}
        <div class="d-flex justify-content-between">
            <button type="submit" name="is_published" value="1" class="btn btn-success">Publish</button>
            <button type="submit" name="is_published" value="0" class="btn btn-secondary">Save as Draft</button>
        </div>
    </form>
</div>
@endsection
