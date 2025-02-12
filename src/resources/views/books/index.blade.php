@extends('layouts.app')

@section('content')

  <!-- Table with books -->
  <table class="table table-bordered">
      <thead>
          <tr>
              <th>Title</th>
              <th>Author</th>
              <th>Actions</th>
          </tr>
      </thead>
      <tbody>
          @foreach ($books as $book)
              <tr>
                  <td>{{ $book->title }}</td>
                  <td>{{ $book->author }}</td>
              </tr>
          @endforeach
      </tbody>
  </table>

@endsection