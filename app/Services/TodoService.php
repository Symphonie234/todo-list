<?php

namespace App\Services;

use App\Models\Todo;
use App\Repositories\Contracts\TodoRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class TodoService
{
    public function __construct(
        protected TodoRepositoryInterface $todoRepository
    ) {}

    public function getAllTodos(?string $status): Collection
    {
        return $this->todoRepository->all($status);
    }

    public function toggleTodoStatus(Todo $todo): Todo
    {
        return $this->todoRepository->toggle($todo);
    }

    public function getTodo(int $id): Todo
    {
        return $this->todoRepository->find($id);
    }

    public function createTodo(array $data): Todo
    {
        return $this->todoRepository->create($data);
    }

    public function updateTodo(Todo $todo, array $data): Todo
    {
        return $this->todoRepository->update($todo, $data);
    }

    public function deleteTodo(Todo $todo): void
    {
        $this->todoRepository->delete($todo);
    }
}