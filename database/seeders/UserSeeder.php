<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::factory()->create(['name' => 'Иванов', 'email' => 'info@datainlife.ru']);
        User::factory()->create(['name' => 'Петров', 'email' => 'job@datainlife.ru']);
    }
}
