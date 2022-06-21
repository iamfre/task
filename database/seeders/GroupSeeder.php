<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group::factory()->create(['name' => 'Группа1', 'expire_hours' => 1]);
        Group::factory()->create(['name' => 'Группа2', 'expire_hours' => 2]);
    }
}
