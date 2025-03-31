<?php

namespace App\Contracts;
use App\Models\Task;
use Illuminate\Pagination\LengthAwarePaginator;

interface TaskInterface
{

    public function tasks(int $first, int $page): LengthAwarePaginator; 
    public function task(string $id): ?Task;
    public function create(array $data): ?Task;
    public function update(string $id, array $data): ?Task;
    public function delete(string $id): bool;
}
