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



    public function update($root, mixed $args): ?Task
    {

        if (!is_array($args) || empty($args)) {
            throw new Exception("Invalid arguments: args must be a non-empty array.");
        }

        if (empty($args['id'])) {
            throw new Exception("Invalid arguments: 'id' is required.");
        }

        if (isset($args['due_date']) && !strtotime($args['due_date'])) {
            throw new Exception("Invalid due_date format. Use YYYY-MM-DD HH:MM:SS.");
        }

        return $this->taskContract->update($args['id'], $args);
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
            'message'     => $delete ? 'Delete complete' : 'Task not found!',
            'status_code' => $delete ? 204 : 404
        ];
    }
    
}
