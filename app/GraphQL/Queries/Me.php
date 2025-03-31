<?php declare(strict_types=1);

namespace App\GraphQL\Queries;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

 class Me {

    public function __invoke(): ?User
    {
        return Auth::user();
    }
}
