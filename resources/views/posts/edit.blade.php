@extends('layouts.app')

@section('content')
    <form action="{{ $action }}" method="POST">
        @csrf @method($method)
        <div class="form-group">
            <label for="post-title">Title</label>
            <input type="text" value="{{ optional($data)->getAttribute('title') }}" name="title" class="form-control" id="post-title" placeholder="Enter title">
            @error('title')
                <p class="text-danger">
                    {{ $message }}
                </p>
            @enderror
        </div>
        <div class="form-group">
            <label for="post-content">Content</label>
            <textarea name="content" class="form-control" placeholder="Content" id="post-content" cols="10" rows="3">{{ optional($data)->getAttribute('content') }}</textarea>
            @error('content')
                <p class="text-danger">
                    {{ $message }}
                </p>
            @enderror
        </div>
        @if (!is_null($action))
            <button type="submit" class="btn btn-primary">Submit</button>            
        @endif
    </form>
@endsection