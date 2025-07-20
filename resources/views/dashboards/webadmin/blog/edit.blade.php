@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0">Edit Blog Post</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('webadmin.blog.update', $blogPost->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="title">Post Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" value="{{ $blogPost->title }}" required>
                        </div>

                        <div class="form-group">
                            <label for="meta_title">Meta Title</label>
                            <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $blogPost->meta_title ?? '') }}">
                        </div>

                        <div class="form-group">
                            <label for="meta_description">Meta Description</label>
                            <textarea name="meta_description" class="form-control" rows="2">{{ old('meta_description', $blogPost->meta_description ?? '') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="keywords">Meta Keywords</label>
                            <input type="text" name="keywords" class="form-control" value="{{ old('keywords', $blogPost->keywords ?? '') }}" placeholder="e.g. laravel, blog, cms">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="categories">Categories <span class="text-danger">*</span></label>
                                <select name="categories[]" class="form-control" multiple required>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">Hold Ctrl/Command to select multiple</small>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="tags">Tags</label>
                                <select name="tags[]" class="form-control" multiple>
                                    @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">Hold Ctrl/Command to select multiple</small>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="content">Content <span class="text-danger">*</span></label>
                            <textarea id="content" name="content" class="form-control" rows="6" required>{{ $blogPost->content }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="image">Post Image</label>
                            <input type="file" name="image" class="form-control-file">
                            @if($blogPost->image)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $blogPost->image) }}" alt="Post Image" width="150" class="img-thumbnail">
                                </div>
                            @endif
                        </div>

                        <div class="text-right mt-4">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('webadmin.blog.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- CKEditor CDN -->
<script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content', {
        height: 300,
        removeButtons: '',
        filebrowserUploadUrl: "{{ route('webadmin.ckeditor.upload') }}?_token={{ csrf_token() }}",
        filebrowserUploadMethod: 'form'
    });
</script>
@endsection
