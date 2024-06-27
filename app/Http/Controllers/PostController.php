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
    }

    public function show($id)
    {
        $post = Post::where('id', $id)->firstOrFail();
        // dd($post);
        return response()->json(['post' => $post]);
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
        return response()->json(['message' => 'Post created successfully']);
    }

    public function update(Request $request, $id)
    {
        // $post = Post::findOrFail($id);
        Log::info('Incoming request data:', $request->all());

        $post = Post::where('id',$id)->firstOrFail();
        
        $request->validate([
            'title' =>'sometimes|string',
            'slug' =>'sometimes|unique:posts,slug',
            'description' => 'sometimes|string|',
            'status' =>'in:Published,Draft',
            'blog_image' =>'nullable|image|mimes:jpef,jpg,png,gif|max:2048'
        ]);

        // Update only post fields that are present/ filled

        $post->title =$request->input('title');
        $post->title =$request->input('slug');
        $post->title =$request->input('description');
        $post->title =$request->input('status');

        if ($request->hasFile('blog_image')) {
            $post->blog_image = $request->input('blog_image');
            // $post->blog_image = $path;
        }

        //save the post inpyuts
        $post->save();

        return response()->json(['message' => 'Post updated successfully', 'post' => $post]);
    }

    public function showPost($id)
    {
        $post = Post::findOrFail($id);
        return response()->json($post);
    }
    // public function destroy(Post $post)
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return response()->json(['message' => 'Post deleted successfully']);
    }

    public function detail($id)
    {

        $post = Post::where('id', $id)->firstOrFail();
        return response()->json($post);
    }
}
