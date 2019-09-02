@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">View All Book
                    <a class="nav-link float-right" href="{{ url('/book/create') }}">{{ __('Add Book') }}</a>
                </div>
                

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table border="2">
                        <tr>
                            <th>Book Title</th>
                            <th>Author</th>
                            <th>Daily Price</th>
                            <th>Book Count</th>
                            <th>Option</th>
                        </tr>
                        @foreach($books as $book)
                        <tr>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->price }}</td>
                            <td>{{ $book->count }}</td>
                            <td>
                                <a href="/book/edit/{{ $book->id }}">Edit</a>
                                |
                                <a href="/book/hapus/{{ $book->id }}">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
