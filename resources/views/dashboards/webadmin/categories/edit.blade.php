@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3>Edit Category</h3>

    <form method="POST" action="{{ route('webadmin.categories.update', $category->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Category Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('webadmin.categories.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
