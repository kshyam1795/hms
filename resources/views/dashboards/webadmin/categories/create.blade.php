@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3>Add New Category</h3>

    <form method="POST" action="{{ route('webadmin.categories.store') }}">
        @csrf
        <div class="form-group">
            <label for="name">Category Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control" placeholder="Enter category name" required>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('webadmin.categories.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
