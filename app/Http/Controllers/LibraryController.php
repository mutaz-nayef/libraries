<?php

namespace App\Http\Controllers;

use App\Models\Library;

class LibraryController extends Controller
{

    public function index()
    {
        return view('libraries.index', [
            'libraries' => Library::paginate(9)
//                ->withLikes()
        ]);
    }

    public function show(Library $library)
    {
        return view('libraries.show', [
            'library' => $library
        ]);
    }

    public function create()
    {
        if (!auth()->user()->library) {
            return view('libraries.create');
        } else {
            return back()->with('flash', 'You have created your library');
        }
    }


    public function store()
    {

        $attributes = request()->validate([
            'name' => 'required|max:255',
            'address' => 'required|max:255',
        ]);
        $library = Library::create([
            'user_id' => auth()->user()->id,
            'name' => $attributes['name'],
            'address' => $attributes['address'],
        ]);

        return redirect('/manager/books')->with('flash', 'Library Created Successfully');

    }
}
