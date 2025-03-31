<?php

namespace App\GraphQL\Queries;

use App\Contracts\TaskInterface;
use App\Models\Task;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class TaskQuery
{


    public function __construct(
        protected TaskInterface $taskContract)
    {}

    public function tasks(): Collection
    {
        return $this->taskContract->tasks();
    }


    public function task($root, $args): ?Task
    {
    
        if (!isset($args) || !is_array($args)) {
            throw new Exception("Invalid arguments: 'args' must be an array.");
        }
    

        if (!isset($args['id']) || !is_string($args['id'])) {
            throw new Exception("Invalid arguments: 'id' is required and must be a string.");
        }
    

        return $this->taskContract->task($args['id']);
    }
}
