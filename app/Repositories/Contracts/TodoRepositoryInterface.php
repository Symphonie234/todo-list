<?php

namespace App\Repositories\Contracts;

use App\Models\Todo;
use Illuminate\Pagination\LengthAwarePaginator;

interface TodoRepositoryInterface
{
    public function all(?string $status, ?string $search): LengthAwarePaginator;

    public function find(int $id): Todo;

    public function toggle(Todo $todo): Todo;

    public function create(array $data): Todo;

    public function update(Todo $todo, array $data): Todo;

    public function delete(Todo $todo): void;
}