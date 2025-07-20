@extends('layouts.app')

@section('content')
    <h1>Edit Post</h1>
    <form action="{{ route('webadmin.blog.update', $blogPost->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="text" name="title" value="{{ $blogPost->title }}" required>
        <input type="text" name="meta_title" value="{{ old('meta_title', $blogPost->meta_title ?? '') }}" placeholder="Meta Title">
        <textarea name="meta_description" rows="3" placeholder="Meta Description">{{ old('meta_description', $blogPost->meta_description ?? '') }}</textarea>
        <input type="text" name="keywords" value="{{ old('keywords', $blogPost->keywords ?? '') }}" placeholder="Keywords (comma-separated)">
        <textarea id="content" name="content" required>{{ $blogPost->content }}</textarea>
        <input type="file" name="image">
        <button type="submit">Update</button>
    </form>
@endsection
