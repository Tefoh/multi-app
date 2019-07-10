<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class)->create(['email' => 'admin@admin.com', 'type' => 'admin']);
        factory(\App\User::class)->create(['email' => 'freelancer@freelancer.com', 'type' => 'freelancer']);
        factory(\App\User::class)->create(['email' => 'user@user.com', 'type' => 'user']);
        factory(\App\User::class, 50)->create();
    }
}
