@extends('welcome')

@section('web-content')

 
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <article class="card shadow-sm border-0">
                @if($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ $post->title }}">
                @endif

                <div class="card-body">
                    <h2 class="card-title">{{ $post->title }}</h2>
                    <div class="mb-3 text-muted small">
                        Posted by <strong>{{ $post->user->name ?? 'Admin' }}</strong> on {{ $post->created_at->format('d M, Y') }}
                    </div>

                    <div class="blog-content" style="text-align: justify;padding: 10px 40px;">
                        {{-- Display the content of the post --}}
                        {{-- You can use Markdown or HTML here, depending on how you store your content --}}
                        {{-- Use {!! !!} to render HTML content safely --}}
                        {{-- If you are using Markdown, you might want to convert it to HTML first --}}
                        {!! $post->content !!}
                    </div>

                    <div class="mt-4">
                        <strong>Tags:</strong>
                        @foreach($post->tags as $tag)
                            <span class="badge bg-primary text-white">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                </div>
            </article>

            <!-- Optional: Social Share Buttons -->
            <div class="mt-4">
                <h5>Share this post:</h5>
                <a class="btn btn-sm btn-outline-info" href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank">Facebook</a>
                <a class="btn btn-sm btn-outline-info" href="https://twitter.com/intent/tweet?url={{ url()->current() }}" target="_blank">Twitter</a>
            </div>
        </div>
    </div>
</div>
@endsection

