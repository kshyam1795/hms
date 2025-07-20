@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3>Add New Tag</h3>
    <form method="POST" action="{{ route('webadmin.tags.store') }}">
        @csrf
        <div class="form-group">
            <label for="name">Tag Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
