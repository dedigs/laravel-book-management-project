@extends('layouts.app')

@section('content')
    <!-- Success message display -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <!-- Sort directions -->
    @php
        $by = $by ?? 'title';
        $direction = (request()->sort == $by && request()->direction == 'asc') ? 'desc' : 'asc';
    @endphp

    <h1>Book List</h1>

    <div class="d-flex justify-content-between">
        <!-- Search form -->
        <form action="{{ route('books.search') }}" method="GET" class="w-50">
            <div class="input-group">
                <input type="text" name="query" class="form-control" placeholder="Search by title or author" value="{{ request('query') }}">
                <button type="submit" class="btn btn-success">Search</button>
            </div>
        </form>
        <!-- Export CSV -->
        <div class="mb-3 d-flex justify-content-end">
            <div class="btn-group me-2">
                <button class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown">Export CSV</button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('books.export.csv', 'titles&authors') }}">Title & Author</a></li>
                    <li><a class="dropdown-item" href="{{ route('books.export.csv', 'titles') }}">Only Titles</a></li>
                    <li><a class="dropdown-item" href="{{ route('books.export.csv', 'authors') }}">Only Authors</a></li>
                </ul>
            </div>
            <!-- Export XML -->
            <div class="btn-group me-2">
                <button class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown">Export XML</button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('books.export.xml', 'titles&authors') }}">Title & Author</a></li>
                    <li><a class="dropdown-item" href="{{ route('books.export.xml', 'titles') }}">Only Titles</a></li>
                    <li><a class="dropdown-item" href="{{ route('books.export.xml', 'authors') }}">Only Authors</a></li>
                </ul>
            </div>
            <a href="{{ route('books.create') }}" class="btn btn-primary">
                Add new Book
            </a>
        </div>
    </div>

    <!-- Table with books -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-light text-center">
                <tr>
                    <th style="width: 40%;">
                        <a href="{{ route('books.sort', ['by' => 'title', 'sort' => 'title', 'direction' => $direction]) }}" class="text-dark">
                            Title
                            @if(request()->sort == 'title')
                                @if(request()->direction == 'asc')
                                    <i class="bi bi-chevron-up"></i>
                                @else
                                    <i class="bi bi-chevron-down"></i>
                                @endif
                            @else
                                <i class="bi bi-chevron-down"></i>
                            @endif
                        </a>
                    </th>
                    <th style="width: 30%;">
                        <a href="{{ route('books.sort', ['by' => 'author', 'sort' => 'author', 'direction' => $direction]) }}" class="text-dark">
                            Author
                            @if(request()->sort == 'author')
                                @if(request()->direction == 'asc')
                                    <i class="bi bi-chevron-up"></i>
                                @else
                                    <i class="bi bi-chevron-down"></i>
                                @endif
                            @else
                                <i class="bi bi-chevron-down"></i>
                            @endif
                        </a>
                    </th>
                    <th style="width: 15%;">Edit Author</th>
                    <th style="width: 15%;">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td class="text-center">
                            <!-- Edit button -->
                            <a href="{{ route('books.editAuthor', $book->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        </td>
                        <td class="text-center">
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
    </div>

    @if(request('query'))
        <a href="{{ route('books.index') }}" class="btn btn-secondary">Back</a>
    @endif
@endsection

@section('scripts')
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this book?");
        }
    </script>
@endsection
