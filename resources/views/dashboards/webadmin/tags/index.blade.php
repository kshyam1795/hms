@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3>Tags</h3>
    <a href="{{ route('webadmin.tags.create') }}" class="btn btn-success mb-3">Add Tag</a>

    <table class="table table-bordered">
        <thead><tr><th>Name</th><th>Action</th></tr></thead>
        <tbody>
            @foreach ($tags as $tag)
                <tr>
                    <td>{{ $tag->name }}</td>
                    <td>
                        <a href="{{ route('webadmin.tags.edit', $tag->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('webadmin.tags.destroy', $tag->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
