<?php

namespace App\Contracts;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\Collection;

interface TaskInterface
{

    // public function tasks(): array;
    public function tasks(): \Illuminate\Database\Eloquent\Collection;
    public function task(string $id): ?Task;
    public function create(array $data): ?Task;
    public function update(string $id, array $data): ?Task;
    public function delete(string $id): bool;
}
