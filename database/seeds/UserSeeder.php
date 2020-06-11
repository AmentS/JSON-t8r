<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name' => "Spasoje",
            'email' => "spasoje@example.com",
            'email_verified_at' => now(),
            'password' => bcrypt('spasoje'),
            'remember_token' => Str::random(10)
        ]);

        App\User::create([
            'name' => "admin",
            'email' => "admin@example.com",
            'email_verified_at' => now(),
            'password' => bcrypt('admin'),
            'remember_token' => Str::random(10)
        ]);

        factory(App\User::class, 10)->create();
    }
}
