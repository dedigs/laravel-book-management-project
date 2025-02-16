<?php

use App\Http\Controllers\BookController;

// base CRUD routs for books
Route::resource('books', 'BookController');
// update author
Route::get('/books/{book}/edit-author', [BookController::class, 'editAuthor'])->name('books.editAuthor');
Route::put('/books/{book}/update-author', [BookController::class, 'updateAuthor'])->name('books.updateAuthor');
// sort books
Route::get('/books/sort/{by}', [BookController::class, 'sort'])->name('books.sort');

Route::redirect('/', '/books');
