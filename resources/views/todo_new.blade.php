@extends('layouts.common')


@section('content')

<!-- SweetAlert2 Error Alert -->
@if ($errors->any())
<script>
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'There was an error!',
        html: `<ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>`,
    });
</script>
@endif

<!-- SweetAlert2 Error Alert -->
@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '{{ session('error') }}',
    });
</script>
@endif


<div class="container">
    <h2>Create a New Todo</h2>

   

    <form method="POST" action="{{ route('todo.store') }}">
        @csrf

        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title">
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="completed" name="completed" value="1">
            <label class="form-check-label" for="completed">Completed</label>
        </div>


        <button type="submit" class="btn btn-primary">Create Todo</button>
    </form>
</div>
@endsection