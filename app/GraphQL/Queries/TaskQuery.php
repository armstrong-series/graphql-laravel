<?php

namespace App\GraphQL\Queries;

use App\Contracts\TaskInterface;
use App\Models\Task;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;

class TaskQuery
{


    public function __construct(
        protected TaskInterface $taskContract
    ) {}



    public function tasks($root, array $args): LengthAwarePaginator
    {
        return $this->taskContract->tasks($args['first'], $args['page'] ?? 1);
    }


    public function task($root, array $args): ?Task
    {
        

        if (!isset($args['id']) || !is_string($args['id'])) {
            throw new Exception("Invalid Identifier!");
        }
        
        $task = $this->taskContract->task($args['id']);

       
        if (!$task) {
            throw new Exception("Invalid Task ID!");
        }

        return $task;
    }
}
