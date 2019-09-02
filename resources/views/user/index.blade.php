@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">View All User
                    @if(Auth::user()->admin == 1)
                    <a class="nav-link float-right" href="{{ url('/user/create') }}">{{ __('Add User') }}</a>
                    @endif
                </div>
                

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table border="2">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            @if(Auth::user()->admin == 1)
                            <th>Option</th>
                            @endif
                        </tr>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            @if(Auth::user()->admin == 1)
                            <td>
                                <a href="/user/{{ $user->id }}/edit">Edit</a>
                                |
                                <a href="/user/{{ $user->id }}">Delete</a>
                            </td>
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