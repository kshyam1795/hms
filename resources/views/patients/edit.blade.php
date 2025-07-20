@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Edit Patient</h4>
    <form action="{{ route('patients.update', $patient->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $patient->name }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $patient->email }}" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ $patient->phone }}" required>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <textarea name="address" class="form-control" required>{{ $patient->address }}</textarea>
        </div>
        <div class="form-group">
            <label for="dob">Date of Birth</label>
            <input type="date" name="dob" class="form-control" value="{{ $patient->dob }}" required>
        </div>
        <select name="gender" id="gender">
            <option value="">Choose Gender</option>
            <option value="male" {{ $patient->gender == 'male' ? 'selected' : '' }}>Male</option>
            <option value="female" {{ $patient->gender == 'female' ? 'selected' : '' }}>Female</option>
            <option value="others" {{ $patient->gender == 'others' ? 'selected' : '' }}>Others</option>
            
        </select>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
