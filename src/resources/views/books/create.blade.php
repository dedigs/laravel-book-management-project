@extends('layouts.app')

@section('content')
  <h1 class="mb-4">Add new book</h1>

  <form action="{{ route('books.store') }}" method="POST">
    @csrf
    <!-- Error message display -->
    @if ($errors->any())
    <div class="alert alert-danger">
      <ul style="margin-bottom: 0">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    <div class="mb-3">
      <label for="title" class="form-label">Title</label>
      <input type="text" name="title" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="author" class="form-label">Author</label>
      <input type="text" name="author" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Add Book</button>
  </form>
@endsection
