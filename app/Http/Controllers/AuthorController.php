<?php

namespace App\Http\Controllers;

use App\Models\Author;

class AuthorController extends Controller
{
    public function index()
    {
        return view('authors.index', [
            'authors' => Author::paginate(9)
        ]);
    }

    public function show(Author $author)
    {
        return view('authors.show', [
            'author' => $author
        ]);
    }
}
