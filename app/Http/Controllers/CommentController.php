<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'news_id' => 'required|exists:news,id',
            'comment' => 'required|string',
        ]);

        Comment::create([
            'name' => $request->input('name'),
            'news_id' => $request->input('news_id'),
            'content' => $request->input('comment'),
        ]);

        return redirect()->back()->with('success', 'Comment posted successfully.');
    }
}
