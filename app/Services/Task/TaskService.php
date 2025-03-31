<?php

namespace App\Services\Task;

use App\Contracts\TaskInterface;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class TaskService implements TaskInterface
{

    public function tasks(): Collection
    {
        return Task::with('user')->get();
    }



    public function task(string $id): ?Task
    {
        return Task::where('id', $id)->first();
    }


    public function create(array $data): ?Task
    {
        $user = Auth::user();
    
        if (!$user) {
            throw new \Exception("Unauthorized!");
        }
    
        $task = Task::create([
            'title'       => $data['title'],
            'status'      => $data['status'],
            'description' => $data['description'] ?? null,
            'due_date'    => $data['due_date'],
            'user_id'     => $user->id,
        ]);
    
        return $task; 
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
