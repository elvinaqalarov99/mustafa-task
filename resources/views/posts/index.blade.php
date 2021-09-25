@extends('layouts.app')

@section('content')
@if (session()->get('message'))
    <div class="alert alert-info" role="alert">
        {{ session()->get('message') }}
  </div>
@endif
<div class="row mb-3 float-right">
    <div class="col-12">
        <a href="{{ route('posts.create') }}" class="btn btn-outline-success">Add</a>
    </div>
</div>
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Content</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($posts as $post)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $post->getAttribute('title') }}</td>
                <td>{{ $post->getAttribute('content') }}</td>
                <td>
                    <a href="{{ route('posts.show', $post) }}" class="btn btn-outline-success">Show</a>
                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-outline-primary">Edit</a>
                    <button class="btn btn-outline-danger" onclick="deleteConfirmation('posts', {{ $post->getAttribute('id') }})">DELETE</button>
                    {{-- <form class="d-inline" action="{{ route('posts.destroy', $post) }}" method="POST">
                        @csrf @method("DELETE")
                        <button class="btn btn-outline-danger" >DELETE</button>
                    </form> --}}
                </td>
            </tr>
        @endforeach
    </tbody>
  </table>

@endsection