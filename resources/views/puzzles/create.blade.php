@extends('layouts.header')

@section('title', 'Add Puzzle')

@section('content')
    <h1>Add Puzzle</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="post" action="{{ route('puzzle.store') }}">
        @csrf

        <label for="title">Title:</label>
        <input type="text" name="title" id="title" value="{{ old('title') }}" required>
        @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label for="description">Description:</label>
        <textarea name="description" id="description" required>{{ old('description') }}</textarea>
        @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label for="tags">Tags (comma-separated):</label>
        <input type="text" name="tags" id="tags" value="{{ old('tags') }}" placeholder="Tag1, Tag2, Tag3">

        <button type="submit">Add Puzzle</button>
    </form>
@endsection
