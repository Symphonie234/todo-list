<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Models\Todo;
use App\Services\TodoService;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function __construct(
        protected TodoService $todoService
    ) {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): View
    {
        $status = $request->query('status');
        $search = $request->query('search');
        $todos = $this->todoService->getAllTodos($status, $search);

        return view('todos.index', compact('todos', 'status', 'search'));
    }

    public function toggle(Todo $todo): RedirectResponse
    {
        $this->todoService->toggleTodoStatus($todo);

        return redirect()
            ->route('todos.index')
            ->with('success', 'Todo status updated successfully.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('todos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreTodoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTodoRequest $request): RedirectResponse
    {
        $this->todoService->createTodo($request->validated());

        return redirect()
            ->route('todos.index')
            ->with('success', 'Todo created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Todo $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo): View
    {
        return view('todos.edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreTodoRequest  $request
     * @param  Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTodoRequest $request, Todo $todo): RedirectResponse
    {
        $this->todoService->updateTodo($todo, $request->validated());

        return redirect()
            ->route('todos.index')
            ->with('success', 'Todo updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Todo $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo): RedirectResponse
    {
        $this->todoService->deleteTodo($todo);

        return redirect()
            ->route('todos.index')
            ->with('success', 'Todo deleted.');
    }
}
