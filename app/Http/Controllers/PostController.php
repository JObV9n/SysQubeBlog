<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        //not for the admin but for all the users
        return response()->json($posts);
        // return view('dashboard', compact('posts'));
    }

    public function landing()
    {
        $posts = Post::where('status', 'Published')->get();
        return view('landing', compact('posts'));
    }
    // public function show($id)
    // {
    //     return Post::findOrFail($id);
    // }

    // public function show($slug)
    // {
    //     $post = Post::where('slug', $slug)->firstOrFail();
    //     return view('post', compact('post'));
    // }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:posts,slug',
            'description' => 'required',
            'status' => 'required|in:Published,Draft',
            'blog_image' => 'image|nullable'
        ]);

        $post = new Post($request->all());

        if ($request->hasFile('blog_image')) {
            $path = $request->file('blog_image')->store('blog_images');
            $post->blog_image = $path;
        }

        $post->save();

        // return redirect()->route('posts.index');
        return response()->json(['message' => 'Post created successfully']);
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post, $id)
    {
        $post = Post::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:posts,slug,' . $post->id,
            'description' => 'required',
            'status' => 'required|in:Published,Draft',
            'blog_image' => 'image|nullable'
        ]);

        $post->fill($request->all());

        if ($request->hasFile('blog_image')) {
            $path = $request->file('blog_image')->store('blog_images');
            $post->blog_image = $path;
        }

        $post->save();

        // return redirect()->route('posts.index');
        return response()->json(['message' => 'Post updated successfully']);
    }

    // public function destroy(Post $post)
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        // return redirect()->route('posts.index');
        return response()->json(['message' => 'Post deleted successfully']);
    }

    public function detail($id){

        $post= Post::where('id',$id)->firstOrFail();
        return response()->json($post);
    }
}
