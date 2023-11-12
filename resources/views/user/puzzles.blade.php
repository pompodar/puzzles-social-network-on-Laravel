@extends('layouts.header')

@section('content')
    <h1>Puzzles by {{ $user->name }}</h1>

    @foreach ($puzzles as $puzzle)
        <div>
            <h2>{{ $puzzle->title }}</h2>
            <p>{{ $puzzle->description }}</p>

            @auth
            
            <div class='puzzle-like cursor-pointer p-1 inline-block' data-like=false id='puzzle-{{ $puzzle->id }}-like'>like</div>
            
            @endauth
            
        </div>
    @endforeach
@endsection
