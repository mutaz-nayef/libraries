<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;


    protected $with = ['category', 'author']; // this for decrease the sql query more  performance

    public function scopeFilter($query, array $filters)
    {

        $query->when($filters['search'] ?? false, fn($query, $search) => $query->where(fn($query) => $query->where('title', 'like', '%' . $search . '%')
            ->orWhere('ispn', 'like', '%' . $search . '%')
            ->orWhere('published_at', 'like', '%' . $search . '%')))->where('library_id', auth()->user()->library->id);

        $query->when($filters['author'] ?? false, fn($query, $author) => $query->whereHas('author', fn($query) => $query->where('name', $author)));

        $query->when($filters['category'] ?? false, fn($query, $category) => $query->whereHas('category', fn($query) => $query->where('slug', $category)));


    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function library()
    {
        return $this->belongsTo(Library::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}




