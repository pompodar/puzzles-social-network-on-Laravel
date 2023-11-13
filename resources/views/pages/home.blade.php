@extends('layouts.header')

@section('title', 'Головоломки')

@section('content')

<div class="puzzles-grid p-4 flex gap-2">

    @foreach ($puzzles as $puzzle)
        <div class="puzzle-card w-80 bg-white rounded">
            <h2 class="text-lg p-4">{{ $puzzle->title }}</h2>
            <hr />
            <p class="text-base p-4">
                {{\Illuminate\Support\Str::limit($puzzle->description, 130)}}
            </p>

            <p class="puzzle-card__author text-amber-500 text-sm px-4 py-2">by <a href="{{ route('user.puzzles', ['userId' => $puzzle->user->id]) }}">{{ $puzzle->user->name }}</a></p>

            <div class="puzzle-card__footer flex justify-between items-center bg-amber-500 p-4">
                
                {{-- Display tags --}}
                <div class="text-sm">
                    tags:
                    @foreach ($puzzle->tags as $tag)
                        <span class="tag">{{ $tag->name }}</span>
                    @endforeach
                </div>

                {{-- Display number of comments --}}
                <p class="text-sm">{{ $puzzle->comments->count() }} {{ $puzzle->comments->count() === 1 ? 'answer' : 'answers' }}</p>

                {{-- Display comments --}}
                <!-- <h3 class="text-sm">Comments:</h3>
                @foreach ($puzzle->comments as $comment)
                    <div>
                        <p class="text-sm">{{ $comment->content }}</p>
                        <p class="text-sm">by {{ $comment->user->name }}</p>
                    </div>
                @endforeach -->

                <!-- @auth
                    <form method="post" action="{{ route('puzzle.addComment', ['puzzleId' => $puzzle->id]) }}">
                        @csrf
                        <textarea name="content" placeholder="Add a comment"></textarea>
                        <button type="submit">Add Comment</button>
                    </form>
                @endauth -->
                
                <div class="flex">

                @auth
                    <div class='text-sm puzzle-like cursor-pointer p-1 inline-block' 
                        id='puzzle-{{ $puzzle->id }}-like'
                    >

                    {!! $puzzle->likes()->where('user_id', auth()->id())->exists() ? '<i class="fas fa-heart"></i>' : '<i class="far fa-heart"></i>' !!}
                        
                    </div>  
                    
                @endauth

                <p class="text-sm">{{ $puzzle->likes_count }} 
                    <!-- {{ $puzzle->likes_count === 1 ? 'user ' : 'users '}} liked this puzzle -->
                </p>

            </div>
        </div>    
            
        </div>
    @endforeach

</div>

<!-- Pagination Links -->
<div class="pagination">
    {{ $puzzles->links() }}
</div>

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
