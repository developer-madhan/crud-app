@extends('layouts.common')

@section('content')
<div class="container">
    <h1>Edit Todo</h1>
    <form action="{{ route('todo.update', $todo->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $todo->title }}">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description">{{ $todo->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="completed">Status</label>
            <select class="form-control" id="completed" name="completed">
                <option value="1" {{ $todo->completed ? 'selected' : '' }}>Done</option>
                <option value="0" {{ !$todo->completed ? 'selected' : '' }}>Work in progress</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('todo.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
