<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.edit', [
            'action' => route('posts.store'),
            'method' => null,
            'data'   => null
        ]);
    }

    public function store(PostRequest $request)
    {
        Post::create($request->validated());

        return redirect()->route('posts.index')->with('message', 'Created successfully!');
    }

    public function show(Post $post)
    {
        return view('posts.edit', [
            'action' => null,
            'method' => null,
            'data'   => $post
        ]);
    }

    public function edit(Post $post)
    {
        return view('posts.edit', [
            'action' => route('posts.update', $post),
            'method' => "PUT",
            'data'   => $post
        ]);
    }

    public function update(PostRequest $request, Post $post)
    {
        $post->update($request->validated());
        
        return redirect()->route('posts.index')->with('message', "Post {$post->getAttribute('title')} updated successfully!");
    }

    public function destroy(Post $post)
    {
        if($post->delete()){
            return redirect()->route('posts.index')->with('message', "Post deleted successfully!");
        }else{
            return redirect()->route('posts.index')->with('message', "Error occured while deleting post!");
        }
    }
}