@extends('layouts.app')

@section('content')
@if (session()->get('message'))
    <div class="alert alert-info" role="alert">
        {{ session()->get('message') }}
  </div>
@endif
    @can('create', App\Models\Post::class)
        <div class="row mb-3 float-right">
            <div class="col-12">
                <a href="{{ route('posts.create') }}" class="btn btn-outline-success">Add</a>
            </div>
        </div>
    @endcan

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
                    @guest
                        <a href="{{ route('posts.show', $post) }}" class="btn btn-outline-success">Show</a>
                    @else
                        @can('view', $post)
                            <a href="{{ route('posts.show', $post) }}" class="btn btn-outline-success">Show</a>
                        @endcan
                        @can('update', $post)
                             <a href="{{ route('posts.edit', $post) }}" class="btn btn-outline-primary">Edit</a>
                        @endcan
                        @can('delete', $post)
                            <button class="btn btn-outline-danger" onclick="deleteConfirmation('posts', {{ $post->getAttribute('id') }})">DELETE</button>
                        @endcan
                    @endguest
                </td>
            </tr>
        @endforeach
    </tbody>
  </table>

@endsection
