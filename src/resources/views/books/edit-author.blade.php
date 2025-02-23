@extends('layouts.app')

@section('content')
    <h1 class="mb-4 text-center">Edit Author</h1>

    <form action="{{ route('books.updateAuthor', $book->id) }}" method="POST" class="col-md-6 mx-auto">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="author" class="form-label">Author</label>
            <input type="text" name="author" class="form-control" value="{{ $book->author }}" required>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('books.index') }}" class="btn btn-secondary">Back to List</a>
            <button type="submit" class="btn btn-success">Update Author</button>
        </div>
    </form>
@endsection
