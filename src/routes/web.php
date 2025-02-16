<?php

// base CRUD routs for books
Route::resource('books', BookController::class);

Route::get('/books/{book}/edit-author', [App\Http\Controllers\BookController::class, 'editAuthor'])->name('books.editAuthor');
Route::put('/books/{book}/update-author', [App\Http\Controllers\BookController::class, 'updateAuthor'])->name('books.updateAuthor');

Route::redirect('/', '/books');
