@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Category Details</h1>
    <h2>{{ $category->name }}</h2>
    <p>{{ $category->description }}</p>
    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Edit</a>
    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back to Categories</a>
</div>
@endsection
