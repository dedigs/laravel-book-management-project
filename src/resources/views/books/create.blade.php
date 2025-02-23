@extends('layouts.app')

@section('content')
  <h1 class="mb-4 text-center">Add New Book</h1>

  <div class="container">
    <form action="{{ route('books.store') }}" method="POST" class="col-md-6 mx-auto">
      @csrf
      <!-- Error message display -->
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
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

      <div class="d-flex justify-content-between">
        <a href="{{ route('books.index') }}" class="btn btn-secondary">Back to List</a>
        <button type="submit" class="btn btn-primary">Add Book</button>
      </div>
    </form>
  </div>
@endsection
