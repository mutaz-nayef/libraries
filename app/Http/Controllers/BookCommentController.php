<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Comment;

class BookCommentController extends Controller
{

    public function store(Book $book)
    {
        request()->validate([
            'body' => 'required|max:255'
        ]);

        $comment = $book->comments()->create([
            'user_id' => request()->user()->id,
            'body' => request('body'),
        ]);
        
        $comment->user = auth()->user()->name;
        return response()->json(['status' => 'sucess', 'message' => $comment]);
    }

    public function index(Book $book)
    {   
        $comments = $book->comments ;
        return response()->json($comments);
    }

}
