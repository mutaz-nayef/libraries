<?php

namespace App\Http\Livewire;

use App\Models\Author;
use App\Models\Book;
use App\Models\Library;
use Livewire\Component;

class SearchDropdown extends Component
{
    public $search = '';

    public function render()
    {
        $books = [];
        $authors = [];
        $libraries = [];
        if (strlen($this->search) >= 2) {

            $books = Book::where('title', 'like', '%' . $this->search . '%')
                ->orWhere('ispn', 'like', '%' . $this->search . '%')
                ->get();

            $authors = Author::where('name', 'like', '%' . $this->search . '%')
                ->get();

            $libraries = Library::where('name', 'like', '%' . $this->search . '%')
                ->get();
        }
        return view('livewire.search-dropdown', [
//            'books' => collect($books)->take(10)
            'books' => $books,
            'authors' => $authors,
            'libraries' => $libraries
        ]);
    }
}
