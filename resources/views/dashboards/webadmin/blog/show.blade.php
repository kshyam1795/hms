@extends('layouts.app')

@section('content')
    <h1>{{ $blogPost->title }}</h1>
    <p>By: {{ $blogPost->user?->name ?? 'Unknown Author' }}</p>
    <img src="{{ asset('storage/' . $blogPost->image) }}" width="300" alt="">
    <p>{{ $blogPost->content }}</p>
    <a href="{{ route('webadmin.blog.index') }}">Back to list</a>
@endsection
