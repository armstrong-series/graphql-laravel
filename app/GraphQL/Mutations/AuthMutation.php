<?php

namespace App\GraphQL\Mutations;
use App\Contracts\AuthInterface;
use Exception;

class AuthMutation
{

    public function __construct(
        protected AuthInterface $authService
        ){}


        public function signin($root, array $args): array
        {
           

            if (empty($args['email']) || empty($args['password'])) {
                throw new Exception("Email and password are required.");
            }
    
            return $this->authService->signin([
                'email'    => $args['email'],
                'password' => $args['password'],
            ]);
        }
}
