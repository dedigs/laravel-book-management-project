@extends('layouts.app')

@section('content')
    <!-- Success message display -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h1>Book List</h1>
    <!-- Sort buttons -->
    <div class="mb-3">
        <a href="{{ route('books.sort', 'title') }}" class="btn btn-secondary">Sort by Title</a>
        <a href="{{ route('books.sort', 'author') }}" class="btn btn-secondary">Sort by Author</a>
    </div>
    <!-- Search form -->
    <form action="{{ route('books.search') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="query" class="form-control" placeholder="Search by title or author" value="{{ request('query') }}">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>
    <!-- Table with books -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Edit Author</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>
                        <!-- Edit button -->
                        <a href="{{ route('books.editAuthor', $book->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    </td>
                    <td>
                        <!-- Delete button -->
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline" onsubmit="return confirmDelete()">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if(request('query'))
        <a href="{{ route('books.index') }}" class="btn btn-secondary">Back</a>
    @else
        <a href="{{ route('books.create') }}" class="btn btn-primary">Add new Book</a>
    @endif
@endsection

@section('scripts')
<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this book?");
    }
</script>
@endsection
