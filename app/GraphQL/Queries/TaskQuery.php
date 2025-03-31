<?php

namespace App\GraphQL\Queries;

use App\Contracts\TaskInterface;
use App\Models\Task;
use Illuminate\Support\Facades\Log;
use Exception;

class TaskQuery
{

    protected $taskService;

    public function __construct(TaskInterface $taskService)
    {
        $this->taskService = $taskService; 
    }

    public function tasks(): array
    {
        return $this->taskService->tasks();
    }


    public function task($root, $args): ?Task
    {
       


        Log::info('TaskQuery@task received:', ['args' => $args]);

        if (!isset($args) || !is_array($args)) {
            throw new Exception("Invalid arguments: 'args' must be an array.");
        }
    

        if (!isset($args['id']) || !is_string($args['id'])) {
            throw new Exception("Invalid arguments: 'id' is required and must be a string.");
        }
    

        return $this->taskService->task($args['id']);
    }
}
