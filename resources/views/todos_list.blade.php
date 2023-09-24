@extends('layouts.common')
@section('content')
<h1>This is list page!!!</h1>
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="container">
    @if(count($todos) > 0)
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($todos as $todo)
            <tr>
                <td>{{ $todo->title }}</td>
                <td>{{ $todo->description }}</td>
                <td>{{ $todo->completed ? 'Done' : 'Work in progress' }}</td>
                <td>
                    <!-- Show Button -->
                    <a href="{{ route('todo.show', $todo->id) }}" class="btn btn-info btn-sm">
                        <i class="fas fa-eye"></i> Show
                    </a>

                    <!-- Edit Button -->
                    <a href="{{ route('todo.edit', $todo->id) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>

                    <!-- Destroy Button -->
                    <form action="{{ route('todo.destroy', $todo->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this todo?')">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @else
    <div class="alert alert-info">
        <p>No todos found.</p>
    </div>
    @endif
</div>


@endsection