<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookCommentController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\LibraryLikesController;
use App\Http\Controllers\ManagerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('test', function() {
    return response()->json(['data' => 'You have liked the Library'], 200);
});
Route::get('test/books',function(){
   return view("test");
});

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/admin/dashboard', [AdminController::class, 'index'])->middleware('can:admin')->name('admin.dashboard');
Route::get('/admin/user/update{user:id}', [AdminController::class, 'update'])->middleware('can:admin')->name('admin.user.update');

Route::get('/manager/books', [ManagerController::class, 'index'])->middleware('can:manager')->name('manager.books');
Route::post('/manager/books', [ManagerController::class, 'index'])->middleware('can:manager')->name('');
Route::get('/manager/books/create', [ManagerController::class, 'create'])->middleware('can:manager')->name('manager.book.create');
Route::post('/manager/books/store', [ManagerController::class, 'store'])->middleware('can:manager')->name('manager.book.store');
Route::get('/manager/books/edit/{book:id}', [ManagerController::class, 'edit'])->middleware('can:manager')->name('manager.book.edit');
Route::post('/manager/books/update/{book:id}', [ManagerController::class, 'update'])->middleware('can:manager')->name('manager.book.update');
Route::get('/manager/books/destroy/{book:id}', [ManagerController::class, 'destroy'])->middleware('can:manager')->name('manager.book.destroy');

Route::get('/libraries', [LibraryController::class, 'index'])->name('libraries.index');
Route::get('/libraries/{library}', [LibraryController::class, 'show'])->name('library.show');

Route::get('/library/create', [LibraryController::class, 'create'])->middleware('can:manager')->name('library.create');
Route::post('/library/store', [LibraryController::class, 'store'])->middleware('can:manager')->name('library.store');

Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{book}', [BookController::class, 'show'])->name('book.show');

Route::post('books/{book:id}/comments', [BookCommentController::class, 'store'])->middleware('auth');

Route::get('/authors', [AuthorController::class, 'index'])->name('authors.index');
Route::get('/authors/{author:id}', [AuthorController::class, 'show'])->name('author.show');


Route::post('/libraries/{library}/like', [LibraryLikesController::class, 'store'])->middleware('auth')->name('like.library');
//Route::delete('/libraries/{libraries}/like', [LibraryLikesController::class, 'destroy']);
// Route::post('/books/{book:title}/comments',[BookCommentController::class ,'sotre']);

require __DIR__ . '/auth.php';
