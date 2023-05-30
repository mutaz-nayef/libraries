<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;

class ManagerController extends Controller
{
    public function index()
    {
        if (!auth()->user()->library) {

            return redirect('library/create')->with('flash', 'Create your first library to add book!');

        } else {

            return view('manager.dashboard', [
                'books' => Book::latest()
                    ->filter(request(['search', 'category', 'author']))
                    ->paginate(6)->withQueryString(),
                'authors' => Author::all(),
                'categories' => Category::all()
            ]);
           //  $books =  Book::latest()
           //     ->filter(request(['search', 'category', 'author']))
           //     ->paginate(6)->withQueryString();
           //      return response()->json(['status' => 'sucess',
           //     'books' => $books,
           //     'authors' => Author::all(),
           //     'categories' => Category::all()
           // ],200);
        }
    }

    public function create()
    {
        return view('manager.create', [
            'authors' => Author::all(),
            'categories' => Category::all()
        ]);
    }

    public function store()
    {
        if (request()->file('image')) {
            $attributes['image'] = request()->file('image')->store('images');
        } else {
            $attributes['image'] = '';
        }
       $book = Book::create(array_merge($this->validateBook(), [
            'library_id' => auth()->user()->library->id,
            'image' => $attributes['image']
        ]));

        return response()->json(['status' => 'sucess', 'message' => $book, 'id' => $book->id , 'author' => $book->author->name]);

    }

    public function edit(Book $book)
    {
        // return view('manager.update', [
            // 'book' => $book,
            // 'authors' => Author::all(),
            // 'categories' => Category::all()
        // ]);
        return response()->json([
            'book' => $book,
            'authors' => Author::all(),
            'categories' => Category::all()
        ]);
    }

    public function update(Book $book)
    {
//        if (request()->file('image')) {
//            $attributes['image'] = request()->file('image')->store('images');
//        } else {
//            $attributes['image'] = '';
//        }

        $attributes = $this->validateBook($book);
        if ($attributes['image'] ?? false) {
            $attributes['image'] = request()->file('image')->store('images');
        }else {
            $attributes['image'] = '';
        }
        $attributes['library_id'] = auth()->user()->library->id;
        $book->update($attributes);
        // return redirect('manager/books')->with('flash', 'Book Updated!');
        return response()->json(['message' => 'success','request' => request()->all(),'id' => $book->id,'author' => $book->author->name]);
    }

    public function destroy($id)
    {
        Book::destroy($id);
        // return back()->with('flash', 'Book Deleted Successfully');
    }

    /**
     * @param Book $book
     * @return array
     */
    protected function validateBook(?Book $book = null): array
    {
        $book ?? new Book();
        $attributes = request()->validate([
//            'author_id' => ['required', Rule::exists('authors', 'id')],
            'author_id' => 'required',
//            'category_id' => ['required', Rule::exists('categories', 'id')],
            'category_id' => 'required',
            'ispn' => 'required|min:13|max:13',
                        // 'image' => $book->exists ? 'image' : '',
            'image' =>  '',
            'title' => 'required',
            'published_at' => 'required'
        ]);
        return $attributes;
    }
}
