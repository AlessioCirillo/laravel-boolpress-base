@extends('layouts.main')

@section('content')
    <div class="container mb-5">
        <h1>{{ $post->title }}</h1>
        <h5>Last update: {{ $post->updated_at->diffForHumans() }}</h5>

        <div class="actions mb-5">
            <a class="btn btn-primary" href="#">Edit</a>
        </div>

        @if(!empty($post->path_img))
            <img src="{{ asset('storage/' . $post->path_img) }}" alt="{{ $post->title }}">
        @else 
            No image updated
        @endif

        <div class="text mb-5 mt-5">{{ $post->body }}</div>
        
    </div>
@endsection