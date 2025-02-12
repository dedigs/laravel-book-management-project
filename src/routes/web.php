<?php

// base CRUD routs for books
Route::resource('books', BookController::class);

Route::redirect('/', '/books');
