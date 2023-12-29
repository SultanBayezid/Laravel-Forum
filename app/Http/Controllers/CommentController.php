<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Auth;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'comment' => 'required', 
    
        ]);

        $comment = new Comment();
        $comment->post_id = $request->post_id;
        $comment->comment = $request->comment;
        $comment->user_id = auth::user()->id;
        $comment->save();

        return redirect()->back()->with('success', 'Comment posted successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required', 
    
        ]);

        $comment = Comment::findOrFail($id);
        $comment->comment = $request->comment;
        $comment->save();

        return redirect()->back()->with('success', 'Comment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);

        if ($comment && $comment->user_id === auth()->user()->id) {
            $comment->delete();
            return redirect()->back()->with('success', 'Comment deleted successfully');
        }

        return redirect()->back()->with('error', 'Unable to delete the comment');
    }
}
