<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   

    public function run(): void
    {
        Role::create(['id' => (string) Str::uuid(), 'name' => 'admin']);
        Role::create(['id' => (string) Str::uuid(), 'name' => 'user']);
        Role::create(['id' => (string) Str::uuid(), 'name' => 'team']);
    }

}
