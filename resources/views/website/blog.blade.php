@extends('welcome')

@section('web-content')



<div class="title-section dark-bg module">
    <div class="grid-container grid-x grid-padding-x">
        <div class="small-12 cell">
            <h1>Blogs</h1>
        </div>
        <div class="small-12 cell">
            <ul class="breadcrumbs">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><span class="show-for-sr">Current:</span> Blogs</li>
            </ul>
        </div>
    </div>
</div>

<div class="information-boxes grey-bg module">
    <div class="grid-container grid-x grid-padding-x">
        
            @forelse($posts as $post)
            <div class="small-12 medium-12 large-12 cell">
                <div class="information-box">
                    <div class="information-icon">
                        @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
                        @else
                            <img src="https://via.placeholder.com/150x100?text=No+Image" alt="No image">
                        @endif
                    </div>
                    <div class="information-text">
                        <h4><a href="{{ route('blog.show', $post->slug) }}">{{ Str::limit($post->title, 70) }}</a></h4>
                        <p>{{ Str::limit(strip_tags($post->content), 150) }}</p>
                        <small class="text-muted">
                            <i class="far fa-user"></i> {{ $post->user->name ?? 'Admin' }} |
                            <i class="far fa-calendar-alt"></i> {{ $post->created_at->format('d M Y') }}
                        </small><br>
                        <a href="{{ route('blog.show', $post->slug) }}">Read Full Post →</a>
                    </div>
                </div>
            </div>
            @empty
                <p class="text-center">No blog posts available at the moment.</p>
            @endforelse
        
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $posts->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
