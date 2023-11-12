@extends('layouts.header')

@section('content')
    <h1>Puzzles by {{ $user->name }}</h1>

    @foreach ($puzzles as $puzzle)
        <div>
            <h2>{{ $puzzle->title }}</h2>
            <p>{{ $puzzle->description }}</p>

            {{-- Display tags --}}
            <div>
                Tags:
                @foreach ($puzzle->tags as $tag)
                    <span class="tag">{{ $tag->name }}</span>
                @endforeach
            </div>

            <div class='puzzle-like cursor-pointer p-1 inline-block {{ $puzzle->likes()->where('user_id', auth()->id())->exists() ? 'liked' : '' }}' 
                id='puzzle-{{ $puzzle->id }}-like'
            >
                &#9829;
            </div>

            <p>{{ $puzzle->likes_count }} {{ $puzzle->likes_count === 0 || $puzzle->likes_count === 1 ? 'user ' : 'users '}} liked this puzzle</p>


        </div>
    @endforeach

    <!-- Pagination Links -->
    {{ $puzzles->links() }}

@endsection
