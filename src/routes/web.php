<?php

use App\Http\Controllers\BookController;

// search book
Route::get('/books/search', [BookController::class, 'search'])->name('books.search');
// base CRUD routes for books
Route::resource('books', 'BookController');
// update author
Route::get('/books/{book}/edit-author', [BookController::class, 'editAuthor'])->name('books.editAuthor');
Route::put('/books/{book}/update-author', [BookController::class, 'updateAuthor'])->name('books.updateAuthor');
// sort books
Route::get('/books/sort/{by}', [BookController::class, 'sort'])->name('books.sort');

Route::redirect('/', '/books');
