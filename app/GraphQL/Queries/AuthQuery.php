<?php

namespace App\GraphQL\Queries;
use App\Contracts\AuthInterface;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;

class AuthQuery
{
    protected $authService;

    public function __construct(AuthInterface $authService)
    {
        $this->authService = $authService;
    }

    public function me($root, array $args): ?User
    {
        try {
            $user = $this->authService->me();
            if (!$user) {
                throw new Exception("No authenticated user found.");
            }
            return $user;
        } catch (Exception $e) {
            Log::error('AuthQuery@me failed: ' . $e->getMessage());
            throw $e; 
        }
    }
}
