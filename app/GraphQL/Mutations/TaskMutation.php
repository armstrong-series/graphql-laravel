<?php

namespace App\GraphQL\Mutations;

use App\Contracts\TaskInterface;
use App\Models\Task;
use Exception;
use Illuminate\Http\JsonResponse;


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


    public function delete($root, $args): bool
    {

        if (!is_array($args) || !isset($args['id'])) {
            throw new \Exception("Invalid arguments: 'id' is missing in TaskMutation@delete.");
        }

        return $this->taskContract->delete($args['id']);
    }
}
