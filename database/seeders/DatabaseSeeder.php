<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

       /* \App\Models\User::factory()->create([
             'name' => 'Carlos Escate',
             'email' => 'stornblood6969@gmail.com',
         ]);*/

        $role = \Spatie\Permission\Models\Role::create(['name' => 'administrador']);
        User::find(1)->assignRole($role);
    }
}
