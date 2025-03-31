<?php

namespace App\Services\Auth;

use Illuminate\Support\Facades\Auth;
use App\Contracts\AuthInterface;
use App\Models\User;

class AuthService implements AuthInterface
{


    public function signin(array $credentials): array
    {
        if (!$token = Auth::guard('api')->attempt($credentials)) {
            return [
                'success' => false,
                'message' => 'Invalid credentials.',
                'token'   => null,
                'user'    => null,
            ];
        }

        $user = Auth::guard('api')->user();

        if ($user->status === 'locked') {
            return [
                'success' => false,
                'message' => 'Account is locked. Please contact support.',
                'token'   => null,
                'user'    => null,
            ];
        }

        return [
            'success' => true,
            'message' => 'Authenticated!',
            'token'   => $token, 
            'user'    => $user,  
        ];
    }
    public function me(): ?User
    {
        return Auth::guard('api')->user();
    }
}
