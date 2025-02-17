<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books')); // same as ['books' => $books]
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255|unique:books,title',
            'author' => 'required|max:255',
        ]);

        Book::create($request->all());
        return redirect()->route('books.index')->with('success', 'Book added successfully.');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted.');
    }

    public function editAuthor(Book $book)
    {
        return view('books.edit-author', compact('book'));
    }

    public function updateAuthor(Request $request, Book $book)
    {
        $request->validate([
            'author' => 'required|max:255',
        ]);

        $book->update(['author' => $request->author]);
        return redirect()->route('books.index')->with('success', 'Author updated successfully.');
    }

    public function sort($by)
    {
        $books = Book::orderBy($by)->get();
        return view('books.index', compact('books'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $books = Book::where('title', 'like', "%$query%")
                     ->orWhere('author', 'like', "%$query%")
                     ->get();
        return view('books.index', compact('books', 'query'));
    }
}
