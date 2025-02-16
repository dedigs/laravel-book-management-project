@extends('layouts.app')

@section('content')

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

    <a href="{{ route('books.create') }}" class="btn btn-primary">Add new Book</a>
@endsection

@section('scripts')
<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this book?");
    }
</script>
@endsection