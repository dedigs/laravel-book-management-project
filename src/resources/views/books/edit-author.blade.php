@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Edit Author</h1>

    <form action="{{ route('books.updateAuthor', $book->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="author" class="form-label">Author</label>
            <input type="text" name="author" class="form-control" value="{{ $book->author }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update Author</button>
    </form>

    <a href="{{ route('books.index') }}" class="btn btn-secondary mt-3">Back to List</a>
@endsection
