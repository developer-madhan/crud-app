@extends('layouts.common')
@section('content')
<h1>This is list page!!!</h1>

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
        text: '{{ session('
        error ') }}',
    });
</script>
@endif

<!-- SweetAlert2 Success Alert -->
@if(session('success'))
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    Toast.fire({
        icon: 'success',
        title: '{{ session('success') }}'
    });
</script>
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
                    <form action="{{ route('todo.destroy', $todo->id) }}" method="POST" class="d-inline delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-sm delete-todo">
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

<script>
    $(document).ready(function() {
        // Handle the click event for delete buttons
        $('.delete-todo').click(function() {
            const deleteForm = $(this).closest('.delete-form');

            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this todo!',
                icon: 'warning',
                timer: 3000,
                timerProgressBar: true,
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel',
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteForm.submit();
                }
            });
        });
    });
</script>

@endsection