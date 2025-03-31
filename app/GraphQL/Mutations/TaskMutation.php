<?php

namespace App\GraphQL\Mutations;

use App\Contracts\TaskInterface;
use App\Models\Task;
use Exception;
use Illuminate\Support\Facades\Log;

class TaskMutation
{


    public function __construct(
        protected TaskInterface $taskService
    ) {}


    public function create($root, mixed $args): Task
    {

        if (!is_array($args) || empty($args)) {
            throw new Exception("Invalid argument type: args must be a non-empty array.");
        }
    
        if (empty($args['title']) || empty($args['status']) || empty($args['due_date'])) {
            throw new Exception("Title, Status, and Due Date are required.");
        }
    
        if (!is_string($args['title']) || !is_string($args['status']) || !is_string($args['due_date'])) {
            throw new Exception("Title, Status, and Due Date must be strings.");
        }
    
        if (!strtotime($args['due_date'])) {
            throw new Exception("Invalid due_date format. Use YYYY-MM-DD HH:MM:SS.");
        }
    
        return $this->taskService->create($args);
    }
    




    public function update($root, mixed $args): ?Task
    {
        throw new Exception("Check for error" . __LINE__ );
        Log::info('TaskMutation@update received:', ['args' => $args, 'type' => gettype($args)]);

        if (!is_array($args) || empty($args)) {
            throw new Exception("Invalid arguments: args must be a non-empty array.");
        }

        if (empty($args['id'])) {
            throw new Exception("Invalid arguments: 'id' is required.");
        }

        if (isset($args['due_date']) && !strtotime($args['due_date'])) {
            throw new Exception("Invalid due_date format. Use YYYY-MM-DD HH:MM:SS.");
        }

        return $this->taskService->update($args['id'], $args);
    }





    public function delete($root, $args): bool
    {
        throw new Exception("Check for error" . __LINE__ );
        Log::info('TaskMutation@delete received:', ['args' => $args]);

        if (!is_array($args) || !isset($args['id'])) {
            throw new \Exception("Invalid arguments: 'id' is missing in TaskMutation@delete.");
        }

        return $this->taskService->delete($args['id']);
    }
}
