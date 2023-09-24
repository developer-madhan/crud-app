@extends('layouts.common')
@section('content')
<div class="container">
    <h1>Show Todo</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $todo->title }}</h5>
            <p class="card-text">{{ $todo->description }}</p>
            <p class="card-text"><strong>Status:</strong> {{ $todo->completed ? 'Done' : 'Work in progress' }}</p>
            <a href="{{ route('todo.index') }}" class="btn btn-primary">Back to List</a>
        </div>
    </div>
</div>
@endsection
