@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Send Notification</h4>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{ route('notifications.send') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="message">Message</label>
            <textarea name="message" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="phone">WhatsApp Number</label>
            <input type="text" name="phone" class="form-control">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Send Notification</button>
    </form>
</div>
@endsection
