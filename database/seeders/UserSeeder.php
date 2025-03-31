<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Services\Auth\RoleService;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleService = new RoleService();


        $adminUser = User::factory()->create([
            'name'   => 'Jonathan Dolphins',
            'email'  => 'jonathan.dolphins@tronweb.co',
            'status' => 'active'
        ]);
        $roleService->assignRole($adminUser, 'admin');

        $teamUser = User::factory()->create([
            'name'   => 'Crawler Stove',
            'email'  => 'crawl.stove@troneweb.co',
            'status' => 'active'
        ]);
        $roleService->assignRole($teamUser, 'team');


        User::factory()->count(3)->active()->create()->each(function ($user) use ($roleService) {
            $roleService->assignRole($user, 'user');
        });

        User::factory()->count(3)->locked()->create()->each(function ($user) use ($roleService) {
            $roleService->assignRole($user, 'user');
        });
    }
}
