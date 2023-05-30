<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;

class BookController extends Controller
{

    public function index()
    {
        return view('books.index', [
            'categories' => Category::with('books')->paginate(4),
        ]);
//            return view('books.index', [
//                'books' => Book::latest()
//                    ->filter(request(['search', 'library', 'author']))
//                    ->paginate(6)->withQueryString(),
//
//                'authors' => Author::all()
//            ]);

    }

    public function show(Book $book)
    {
        return view('books.show', [
            'book' => $book
        ]);
    }

    public function create()
    {
        return view('books.create', [
            'authors' => Author::all()
        ]);
    }

    public function store()
    {
        $attributes = request()->validate([
            'author_id' => 'required',
            'ispn' => 'required|min:9|max:9',
            'title' => 'required|max:255',
            'published_at' => 'required|date',
        ]);
        Book::create([
            'library_id' => auth()->user()->library->id,
            'author_id' => $attributes['author_id'],
            'ispn' => $attributes['ispn'],
            'title' => $attributes['title'],
            'published_at' => $attributes['published_at'],
        ]);

        return redirect('library/books')->with('success', 'Book Created Successfully');
    }

    public function edit($id)
    {
        return view('books.update', [
            'book' => Book::find($id),
            'authors' => Author::all()
        ]);
    }

    public function update($id)
    {

        $attributes = request()->validate([
            'author_id' => 'required',
            'ispn' => 'required|min:9|max:9',
            'title' => 'required|max:255',
            'published_at' => 'required|date',
        ]);
        $book = Book::find($id);
        $book->update([
            'library_id' => auth()->user()->library->id,
            'author_id' => $attributes['author_id'],
            'ispn' => $attributes['ispn'],
            'title' => $attributes['title'],
            'published_at' => $attributes['published_at'],
        ]);

        return redirect('library/books')->with('success', 'Book Updated!');

    }

    public function destroy($id)
    {
        Book::destroy($id);
        return back()->with('success', 'Book Deleted Successfully');
    }
}
