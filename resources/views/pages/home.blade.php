@extends('layouts.header')

@section('title', "Granny's Puzzles")

@section('content')

    <div class="puzzles-grid p-4 flex gap-2">

        @foreach ($puzzles as $puzzle)
            <div onclick="window.location='{{ route('puzzle.show', ['puzzleId' => $puzzle->id]) }}'" class="puzzle-card w-80 bg-white rounded">
                <h2 class="text-lg p-4">{{ $puzzle->title }}</h2>
                <hr />
                <p class="text-base p-4">
                    {{ \Illuminate\Support\Str::limit($puzzle->description, 130) }}
                </p>

                <p class="puzzle-card__author text-amber-500 text-sm px-4 py-2">by {{ $puzzle->user->name }}</p>

                <!-- <p class="puzzle-card__author text-amber-500 text-sm px-4 py-2">by <a class="author text-amber-500" href="{{ route('user.puzzles', ['userId' => $puzzle->user->id]) }}">{{ $puzzle->user->name }}</a></p> -->

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

                    <div class="flex">
                        <div class='text-sm puzzle-like cursor-pointer p-1 inline-block'>
                            {!! 
                                auth()->check() ? 
                                    ($puzzle->likes()->where('user_id', auth()->id())->exists() 
                                        ? '<a href="' . route('puzzle.dislike', ['id' => $puzzle->id]) . '"><i class="fas fa-heart auth"></i></a>' 
                                        : '<a href="' . route('puzzle.like', ['id' => $puzzle->id]) . '"><i class="far fa-heart auth"></i></a>'
                                    )
                                    : '<i class="fas fa-heart"></i>'
                            !!}
                        </div>  
                        
                        <p class="text-sm">{{ $puzzle->likes_count }} 
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

@endsection