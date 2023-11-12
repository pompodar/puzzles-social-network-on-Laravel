@extends('layouts.header')

@section('title', 'Головоломки')

@section('content')

    @foreach ($puzzles as $puzzle)
        <div>
            <h2>{{ $puzzle->title }}</h2>
            <p>{{ $puzzle->description }}</p>
            <p>by <a href="{{ route('user.puzzles', ['userId' => $puzzle->user->id]) }}">{{ $puzzle->user->name }}</a></p>
            
            {{-- Display tags --}}
            <div>
                Tags:
                @foreach ($puzzle->tags as $tag)
                    <span class="tag">{{ $tag->name }}</span>
                @endforeach
            </div>
            
            @auth
                <div class='puzzle-like cursor-pointer p-1 inline-block {{ $puzzle->likes()->where('user_id', auth()->id())->exists() ? 'liked' : '' }}' 
                    id='puzzle-{{ $puzzle->id }}-like'
                >
                    &#9829;
                </div>            
            @endauth

            <p>{{ $puzzle->likes_count }} {{ $puzzle->likes_count === 0 || $puzzle->likes_count === 1 ? 'user ' : 'users '}} liked this puzzle</p>
        
        </div>
    @endforeach

    <!-- Pagination Links -->
    {{ $puzzles->links() }}

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        @if (Route::has('login'))
            <div class="fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                    <!-- <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a> -->
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                    @endif
                @endif
            </div>
        @endif
        
    </div>

@endsection
