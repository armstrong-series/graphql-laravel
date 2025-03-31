<?php

namespace App\Services\Task;

use App\Contracts\TaskInterface;
use App\Models\Task;

class TaskService implements TaskInterface
{

    public function tasks(): array
    {
        return Task::all()->toArray() ?? [];
    }



    public function task(string $id): ?Task
    {
        return Task::where('id', $id)->first();
    }

    public function create(array $data): Task
    {
        return Task::create($data);
    }


    public function update(string $id, array $data): ?Task
    {
        $task = Task::find($id);
        if ($task) {
            $task->update(array_filter($data));
            return $task;
        }
        return null;
    }


    public function delete(string $id): bool
    {
        $task = Task::where('id', $id)->first();
        return $task ? $task->delete() : false;
    }
}
