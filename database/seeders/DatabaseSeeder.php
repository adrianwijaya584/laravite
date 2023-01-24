<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $role= Role::create(["name"=> "admin"]);
        $user= User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            "password"=> Hash::make("test")
        ]);
        $user->assignRole($role);
        Role::create(["name"=> "user"]);
    }
}
