@extends('layouts.header')

@section('title', 'Add Puzzle')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form class="create-puzzle-form" method="post" action="{{ route('puzzle.store') }}">
        @csrf

        <label for="title"></label>
        <input placeholder="title" type="text" name="title" id="title" value="{{ old('title') }}" required>
        @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label for="description"></label>
        <textarea placeholder="description" name="description" id="description" required>{{ old('description') }}</textarea>
        @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label for="tags"></label>
        <input type="text" name="tags" id="tags" value="{{ old('tags') }}" placeholder="math, geometry, etc">

        <button class="submit" type="submit">add puzzle</button>
    </form>
@endsection
