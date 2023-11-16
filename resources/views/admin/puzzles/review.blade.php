@extends('layouts.header')

@section('title', 'All Puzzles')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1>All Puzzles</h1>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

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

                            <form method="post" action="{{ route('admin.puzzles.delete', ['id' => $puzzle->id]) }}" class="inline">
                                @csrf
                                @method('delete')
                                <button type="submit">Delete</button>
                            </form>
                        </div>
                    @endforeach

                    <!-- Pagination Links -->
                    {{ $puzzles->links() }}   

                </div>
            </div>
        </div>
    </div>
@endsection
