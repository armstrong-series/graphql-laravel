<?php

namespace App\GraphQL\Mutations;

use App\Contracts\TaskInterface;
use App\Models\Task;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;

class TaskMutation
{


    public function __construct(
        protected TaskInterface $taskContract
    ) {}


    public function create($root, array $args): ?Task
    {
        return $this->taskContract->create($args);
    }



    public function update($root, array $args): array
    {
        if (!isset($args['id']) || empty($args['id'])) {
            return [
                'success' => false,
                'message' => 'Task ID is required!',
                'status_code' => 400
            ];
        }

        $task = Task::where('id',$args['id'])->first();

        if (!$task) {
            return [
                'success' => false,
                'message' => 'Task not found!',
                'status_code' => 404
            ];
        }

        $updated = $task->update(array_filter([
            'title'       => $args['title'] ?? $task->title,
            'status'      => $args['status'] ?? $task->status,
            'due_date'    => $args['due_date'] ?? $task->due_date,
            'description' => $args['description'] ?? $task->description,
        ]));

        return [
            'success'     => (bool) $updated,
            'message'     => $updated ? 'Update completed!' : 'No changes were made.',
            'status_code' => $updated ? 200 : 304
        ];
    }



    public function delete($root, $args): array
    {
        if (!isset($args['id']) || empty($args['id'])) {
            return [
                'success' => false,
                'message' => 'Task ID is required!',
                'status_code' => 400
            ];
        }
    
        $delete = $this->taskContract->delete($args['id']);
    
        return [
            'success'     => (bool) $delete, 
            'message'     => $delete ? 'Delete completed!' : 'Task not found!',
            'status_code' => $delete ? 204 : 404
        ];
    }
    
}
