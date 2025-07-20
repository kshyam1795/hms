@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Slider Management</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('webadmin.sliders.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card mb-4">
            <div class="card-header">Add New Slider</div>
            <div class="card-body">
                <input type="file" name="image" class="form-control mb-2" required>
                <input type="text" name="title" class="form-control mb-2" placeholder="Slider Title (Optional)">
                <textarea name="description" class="form-control mb-2" placeholder="Description (Optional)"></textarea>
                <input type="url" name="link" class="form-control mb-2" placeholder="URL (Optional)">
                <button class="btn btn-primary">Add Slider</button>
            </div>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Description</th>
                <th>Link</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($sliders as $slider)
            <tr>
                <td><img src="{{ asset('storage/'.$slider->image) }}" width="100"/></td>
                <td>{{ $slider->title }}</td>
                <td>{{ Str::limit($slider->description, 50) }}</td>
                <td><a href="{{ $slider->link }}" target="_blank">{{ Str::limit($slider->link, 30) }}</a></td>
                <td>{{ $slider->is_active ? 'Active' : 'Inactive' }}</td>
                <td>
                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#editSlider{{ $slider->id }}">Edit</button>
                    <form action="{{ route('webadmin.sliders.destroy', $slider->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>

            <!-- Edit Modal -->
            <div class="modal fade" id="editSlider{{ $slider->id }}" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('webadmin.sliders.update', $slider->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5>Edit Slider</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <input type="file" name="image" class="form-control mb-2">
                                <input type="text" name="title" class="form-control mb-2" value="{{ $slider->title }}">
                                <textarea name="description" class="form-control mb-2">{{ $slider->description }}</textarea>
                                <input type="url" name="link" class="form-control mb-2" value="{{ $slider->link }}">
                                <select name="is_active" class="form-control">
                                    <option value="1" {{ $slider->is_active ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ !$slider->is_active ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary">Update</button>
                                <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
        </tbody>
    </table>
</div>

@endsection
