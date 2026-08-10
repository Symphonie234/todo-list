<?php

namespace App\Repositories;

use App\Models\Todo;
use App\Repositories\Contracts\TodoRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class TodoRepository implements TodoRepositoryInterface
{
    public function all(?string $status, ?string $search): LengthAwarePaginator
    {
        $query = Todo::latest()->with('category');

        if ($status === 'active') {
            $query = $query->where('is_done', false);
        } elseif ($status === 'completed') {
            $query = $query->where('is_done', true);
        }

        if ($search !== null) {
            $query = $query->where('title', 'like', "%{$search}%");
        }

        return $query->paginate(5);
    }

    public function find(int $id): Todo
    {
        return Todo::findOrFail($id);
    }

    public function toggle(Todo $todo): Todo
    {
        $todo->update(['is_done' => !$todo->is_done]);

        return $todo;
    }

    public function create(array $data): Todo
    {
        return Todo::create($data);
    }

    public function update(Todo $todo, array $data): Todo
    {
        $todo->update($data);

        return $todo;
    }

    public function delete(Todo $todo): void
    {
        $todo->delete();
    }
}