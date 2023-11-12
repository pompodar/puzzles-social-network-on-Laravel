@extends('layouts.header')

@section('title', 'Users')

@section('content')
    <h1>Users Sorted by Correct Comments</h1>

    <table>
        <thead>
            <tr>
                <th>User</th>
                <th>Correct Comments</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->correct_comments_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
