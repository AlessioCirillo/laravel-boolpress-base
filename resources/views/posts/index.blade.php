@extends('layouts.main')

@section('content')
    <div class="container mb-5">
        <h1>Blog archive</h1>

        @forelse ($posts as $post)
            <div class="mb-5">
                <h2>{{ $post->title }}</h2>
                <h5>{{ $post->created_at->format('d/m/Y') }}</h5>

                <p>{{ $post->body }}</p>
                <a href="{{ route('posts.show', $post->slug ) }}">Read more</a>
            </div>
        @empty
            <p>No post found. <a href="{{ route('posts.create') }}">Create a new one</a> </p>
        @endforelse
    </div>
@endsection