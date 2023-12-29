<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('comments.user')->orderBy('created_at', 'desc')->get();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255', // Validation rule for title
    
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->text = $request->text;
        $post->user_id = auth()->user()->id;
        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Post::with(['comments' => function ($query) {
            $query->with('user')->orderBy('created_at', 'desc');
        }])->find($id);
        
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $commentsCount = $post->comments()->count();

        if ($commentsCount > 0) {
            return redirect()->route('posts.index')->with('error', 'Cannot update. Post has comments.');
        }
         
        $post->title = $request->title;
        $post->text = $request->text;
        $post->user_id = auth()->user()->id;
        $post->save();
        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $commentsCount = $post->comments()->count();
        if ($commentsCount === 0) {
            $post->delete();
            return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
        } else {

            return redirect()->route('posts.index')->with('error', 'Cannot delete. Post has comments.');
        }

    }
}
