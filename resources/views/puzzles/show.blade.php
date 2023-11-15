@extends('layouts.header')

@section('title', $puzzle->title)

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="puzzles-grid puzzles-grid-single p-4 flex gap-2">
        <div class="puzzle-card puzzle-card-single w-80 bg-white rounded">
                <h2 class="text-lg p-4">{{ $puzzle->title }}</h2>
                <hr />
                <p class="text-base p-4">
                    {{ $puzzle->description }}
                </p>

                <p class="puzzle-card__author text-amber-500 text-sm px-4 py-2">by <a class="author text-amber-500" href="{{ route('user.puzzles', ['userId' => $puzzle->user->id]) }}">{{ $puzzle->user->name }}</a></p>

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
                        <div class='text-sm puzzle-like cursor-pointer p-1 inline-block'>
                            {!! 
                                auth()->check() ? 
                                    ($puzzle->likes()->where('user_id', auth()->id())->exists() 
                                        ? '<a href="' . route('puzzle.dislike', ['id' => $puzzle->id]) . '"><i class="fas fa-heart auth"></i></a>' 
                                        : '<a href="' . route('puzzle.like', ['id' => $puzzle->id]) . '"><i class="far fa-heart auth"></i></a>'
                                    )
                                    : '<i class="fas fa-heart"></i>'
                            !!}                        </div>  
                        
                        <p class="text-sm">{{ $puzzle->likes_count }} 
                        </p>
                    </div>
                </div>    
            </div>

            {{-- Add a form for adding new comments --}}
            @auth
                <form class="puzzle-card-single__comments" method="post" action="{{ route('puzzle.addComment', ['puzzleId' => $puzzle->id]) }}">
                    @csrf
                    <label for="content"></label>
                    <textarea placeholder="your answer" name="content" id="content" required></textarea>
                    <button class="submit" type="submit">submit</button>
                </form>
            @endauth

        </div>    
        
@endsection


<script>
    function like(puzzleId) {
        const targetButton = document.querySelectorAll("#puzzle-" + puzzleId + "-like i");

        let isLike;

        targetButton.forEach((element) => {
            isLiked = !element.classList.contains("active");

            element.classList.toggle("active");
        });

        console.log(isLiked);

        fetch(`/puzzle/${puzzleId}/${isLiked ? 'dislike' : 'like'}`, {
            method: 'GET',
        })
        .then((response) => {
            if (response.ok) {
                console.log(response);
            }
        });
    }
</script>