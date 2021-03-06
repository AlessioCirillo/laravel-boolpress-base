@extends('layouts.main')

@section('content')
    <div class="container mb-5">
        <h1>Create new post</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            
        @endif

        <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div class="form-group">
                <label for="title">Title</label>
                <input class="form-control" type="text" name="title" id="title" value="{{ old('title') }}">
            </div>

            <div class="form-group">
                <label for="title">Description</label>
                <textarea class="form-control" name="body" id="body">{{ old('title') }}</textarea>
            </div>

            <div class="form-group">
                <label for="path_img">Image</label>
                <input class="form-control" type="file" name="path_img" id="path_img" accept="image/*">
            </div>

            <div class="form-group">
                <input class="btn btn-primary" type="submit" value="create post">
            </div>
        </form>

    </div>
@endsection