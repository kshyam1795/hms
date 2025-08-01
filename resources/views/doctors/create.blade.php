@extends('layouts.app')

@section('content')
<div class="container" style="padding-top: 65px;">
    <h4>Add Doctor</h4>
    <form action="{{ route('doctors.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="specialization">Specialization</label>
            <input type="text" name="specialization" class="form-control" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
