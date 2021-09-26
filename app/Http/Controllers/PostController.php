<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $validated = $request->validated();

        $validated['state'] = $request->has('state');

        $image_path = 'posts/' . time() . '.' . $request->file('image')->extension();

        $request->file('image')->storeAs('public', $image_path);

        $validated['image'] = $image_path;

        Post::create($validated);

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
        $validated = $request->validated();

        $validated['state'] = $request->has('state');

        if($request->hasFile('image')){
            if(Storage::disk('public')->exists($post->getAttribute('image'))){
                Storage::disk('public')->delete($post->getAttribute('image'));
            }

            $image_path = 'posts/' . time() . '.' . $request->file('image')->extension();

            $request->file('image')->storeAs('public', $image_path);

            $validated['image'] = $image_path;
        }

        $post->update($validated);

        return redirect()->route('posts.index')->with('message', "Post {$post->getAttribute('title')} updated successfully!");
    }

    public function destroy(Post $post)
    {
        if($post->delete()){
            return response()->json(['code' => 200]);
        }else{
            return response()->json(['code' => 400]);
        }
    }
}
