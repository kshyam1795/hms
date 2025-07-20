@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">📝 Create New Blog Post</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('webadmin.blog.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="title">Post Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" placeholder="Enter blog post title" required>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="meta_title">Meta Title</label>
                                <input type="text" name="meta_title" class="form-control" placeholder="SEO title for the post">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="keywords">Meta Keywords</label>
                                <input type="text" name="keywords" class="form-control" placeholder="e.g. laravel, blog, cms">
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="meta_description">Meta Description</label>
                            <textarea name="meta_description" class="form-control" rows="2" placeholder="Short SEO description..."></textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="categories">Categories</label>
                                <div class="d-flex">
                                    <select name="categories[]" id="categorySelect" class="form-control me-2" multiple>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                    <button type="button" class="btn btn-outline-primary" onclick="addCategory()">+</button>
                                </div>
                                <input type="text" id="newCategory" class="form-control mt-2" placeholder="New Category">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tags">Tags</label>
                                <div class="d-flex">
                                    <select name="tags[]" id="tagSelect" class="form-control me-2" multiple>
                                    @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                    @endforeach
                                    </select>
                                    <button type="button" class="btn btn-outline-primary" onclick="addTag()">+</button>
                                </div>
                                <input type="text" id="newTag" class="form-control mt-2" placeholder="New Tag">
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="content">Content <span class="text-danger">*</span></label>
                            <textarea id="content" name="content" class="form-control" rows="8" required></textarea>
                        </div>

                        <div class="form-group mb-4">
                            <label for="image">Post Image</label>
                            <input type="file" name="image" class="form-control-file">
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-check-circle"></i> Publish Post
                            </button>
                            <a href="{{ route('webadmin.blog.index') }}" class="btn btn-outline-secondary ms-2">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- CKEditor -->
<script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content', {
        height: 300,
        removeButtons: '',
        filebrowserUploadUrl: "{{ route('webadmin.ckeditor.upload') }}?_token={{ csrf_token() }}",
        filebrowserUploadMethod: 'form'
    });
</script>

<script>
function addCategory() {
    let name = document.getElementById('newCategory').value;
    if (!name) return alert('Enter category name');
    $.post("{{ route('webadmin.categories.store') }}", {
        _token: "{{ csrf_token() }}",
        name: name
    }, function(data) {
        $('#categorySelect').append(`<option value="${data.id}" selected>${data.name}</option>`);
        $('#newCategory').val('');
    }).fail(() => alert('Error creating category.'));
}

function addTag() {
    let name = document.getElementById('newTag').value;
    if (!name) return alert('Enter tag name');
    $.post("{{ route('webadmin.tags.store') }}", {
        _token: "{{ csrf_token() }}",
        name: name
    }, function(data) {
        $('#tagSelect').append(`<option value="${data.id}" selected>${data.name}</option>`);
        $('#newTag').val('');
    }).fail(() => alert('Error creating tag.'));
}
</script>
@endsection
