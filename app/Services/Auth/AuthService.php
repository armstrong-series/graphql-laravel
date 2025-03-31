<?php

namespace App\Services\Auth;

use Illuminate\Support\Facades\Auth;
use App\Contracts\AuthInterface;
use App\Models\User;

class AuthService implements AuthInterface
{


    public function signin(array $credentials): array
    {
        $user = Auth::guard('api')->user();

        if ($user && $user->status === 'locked') {
            return [
                'success' => false,
                'message' => 'Account is locked. Please contact support.',
                'data' => [],
            ];
        }

        if (!$token = Auth::guard('api')->attempt($credentials)) {
            return [
                'success' => false,
                'message' => 'Invalid credentials.',
                'data' => [],
            ];
        }

        $user = Auth::guard('api')->user();

        return [
            'success' => true,
            'message' => 'Authenticated!',
            'data'    => [
                'email_verified_at' => $user->email_verified_at,
                'role'              => $user->role ? $user->role->name : null,
                'token'             => $token,
            ],
        ];
    }

    public function me(): ?User
    {
        return Auth::guard('api')->user();
    }
}
