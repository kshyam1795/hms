@extends('layouts.app')

@section('content')
    <h1>Create Blog Post</h1>
    <form action="{{ route('webadmin.blog.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="title" placeholder="Title" required>
        <input type="text" name="meta_title"  placeholder="Meta Title">
        <textarea name="meta_description" rows="3" placeholder="Meta Description"></textarea>
        <input type="text" name="keywords"  placeholder="Keywords (comma-separated)">
        <textarea id="content" name="content" placeholder="Write your post here..." required></textarea>
        <input type="file" name="image">
        <button type="submit">Publish</button>
    </form>
@endsection
