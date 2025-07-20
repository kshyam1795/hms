@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3>Edit Tag</h3>
    <form method="POST" action="{{ route('webadmin.tags.update', $tag->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Tag Name</label>
            <input type="text" name="name" class="form-control" value="{{ $tag->name }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
