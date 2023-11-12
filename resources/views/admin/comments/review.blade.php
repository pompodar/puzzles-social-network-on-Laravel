@extends('layouts.header')

@section('title', 'Admin Comments Review')

@section('content')

    <h1>Admin Comments Review</h1>

    @foreach ($puzzlesWithUncheckedComments as $puzzle)
        <div>
            <h2>{{ $puzzle->title }}</h2>
            <p>{{ $puzzle->description }}</p>

            @foreach ($puzzle->comments->where('is_correct', false) as $comment)
                <div>
                    <p>{{ $comment->content }}</p>
                    <p>by {{ $comment->user->name }}</p>

                    <form method="post" action="{{ route('admin.comments.markAsCorrect', ['commentId' => $comment->id]) }}">
                        @csrf
                        <label for="is_correct">Mark as Correct:</label>
                        <input type="checkbox" name="is_correct" id="is_correct" value="1">
                        <button type="submit">Submit</button>
                    </form>

                    <form method="post" action="{{ route('admin.comments.markAsInCorrect', ['commentId' => $comment->id]) }}">
                        @csrf
                        <label for="is_correct">Mark as Incorrect:</label>
                        <input type="checkbox" name="is_correct" id="is_correct" value="-1">
                        <button type="submit">Submit</button>
                    </form>
                </div>
            @endforeach
        </div>
    @endforeach

@endsection
