<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = Todo::all();
        return view('todos_list', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('todo_new');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTodoRequest $request)
    {
        // Validate the request data using the StoreTodoRequest form request class.
        $validatedData = $request->validated();

        // Attempt to create a new todo with the validated data.
        try {
            Todo::create($validatedData);
        } catch (\Exception $e) {
            // Handle any exceptions that may occur (e.g., database errors).
            // You can customize this error handling logic.
            return redirect()->back()->with('error', 'Error creating the todo.');
        }

        return redirect()->route('todo.index')->with('success', 'Todo created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        return view('todo_show', compact('todo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        return view('todo_edit', compact('todo'));
        // return response()->json($todo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTodoRequest $request, Todo $todo)
    {
        $validatedData = $request->validated();

        $todo->update($validatedData);

        return redirect()->route('todo.index')->with('success', 'Todo updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();

        return redirect()->route('todo.index')->with('success', 'Todo deleted successfully.');

    }
}
