@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">View All Book
                    @if(Auth::user()->admin == 1)
                    <a class="nav-link float-right" href="{{ url('/book/create') }}">{{ __('Add Book') }}</a>
                    @else
                    @endif
                </div>
                

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{-- {{ session('status') }} --}}
                            {{ session()->get('success') }}
                        </div>
                    @endif

                    <table border="2">
                        <tr>
                            <th>Book Title</th>
                            <th>Author</th>
                            <th>Daily Price</th>
                            <th>Book Count</th>
                            @if(Auth::user()->admin == 1)
                            <th>Option</th>
                            @endif
                        </tr>
                        @foreach($books as $book)
                        <tr>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->price }}</td>
                            <td>{{ $book->count }}</td>
                            @if(Auth::user()->admin == 1)
                            <td>
                                <a href="{{ route('book.edit', $book->id)}}" class="btn btn-primary">Edit</a>
                                |
                                <form action="{{ route('book.destroy', $book->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                            @else
                            @endif
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
