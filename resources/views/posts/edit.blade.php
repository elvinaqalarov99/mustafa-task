@extends('layouts.app')

@section('content')
    <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
        @csrf @method($method)
        @if ($data)
            <div class="mb-3">
                <img src="{{ asset('storage/' . optional($data)->getAttribute('image')) }}" alt="image" height="200" width="300" style="object-fit: cover">
            </div>
        @endif
        @if ($action)
            <div class="form-group">
                <label for="post-title">Image</label>
                <input type="file" name="image" class="form-control">
                @error('image')
                    <p class="text-danger">
                        {{ $message }}
                    </p>
                @enderror
            </div>            
        @endif
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
        <div class="form-group form-check">
            <input type="checkbox" {{ optional($data)->getAttribute('state') == true ? 'checked' : '' }} name="state" class="form-check-input" id="post-state">
            <label class="form-check-label" for="post-state">Is Active</label>
          </div>
        @if ($action)
            <button type="submit" class="btn btn-primary">Submit</button>            
        @endif
    </form>
@endsection
@section('script')
    @if (is_null($action))
        <script>
            $('form :input').attr('disabled', true)
        </script>
    @endif
@endsection