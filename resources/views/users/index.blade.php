@extends('layouts.header')

@section('title', 'Users')

@section('content')
    <table class="leaderboard-table">
        <thead>
            <tr>
                <th>user</th>
                <th>correct</th>
                <th>incorrect</th>
                <th>total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->correct_comments_count }}</td>
                    <td>{{ $user->incorrect_comments_count }}</td>
                    <td>{{ $user->all_comments_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination">
        {{ $users->links() }}
    </div>

@endsection
