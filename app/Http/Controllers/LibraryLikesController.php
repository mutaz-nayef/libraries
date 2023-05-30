<?php

namespace App\Http\Controllers;

use App\Models\Library;

class LibraryLikesController extends Controller
{


    public function store(Library $library)
    {
        $library->like(auth()->user());
        return response()->json(['status' => 'sucess', 'message' => $library->isLikedBy(auth()->user()),'likes' => $library->likes->count()]);
    }


    public function destroy(Library $library)
    {
        $library->dislike(auth()->user());
        return back();

    }
}
