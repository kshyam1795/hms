@extends('layouts.app')

@section('content')
<div class="container" style="padding-top: 65px;">
    <h4>Receptionists</h4>
    <a href="{{ route('receptionists.create') }}" class="btn btn-primary">Add Receptionist</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($receptionists as $receptionist)
            <tr>
                <td>{{ $receptionist->id }}</td>
                <td>{{ $receptionist->name }}</td>
                <td>{{ $receptionist->email }}</td>
                <td>
                    <a href="{{ route('receptionists.edit', $receptionist->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('receptionists.destroy', $receptionist->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
