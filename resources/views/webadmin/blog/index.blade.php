@extends('layouts.app')

@section('content')
    <h1>Blog Posts</h1>
    <a href="{{ route('webadmin.blog.create') }}" class="btn btn-primary">Create New Post</a>
    <ul>
        @foreach($posts as $post)
            <li>
                <a href="{{ route('blog.show', $post->id) }}">{{ $post->title }}</a>
                <small>by {{ $post->user->name }}</small>
            </li>
        @endforeach
    </ul>
    {{ $posts->links() }}
@endsection
