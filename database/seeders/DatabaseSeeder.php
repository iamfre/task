<?php

namespace Database\Seeders;

use App\Models\GroupUser;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            GroupSeeder::class,
            UserSeeder::class,
        ]);

        GroupUser::factory()->create(['user_id'=> 2 , 'group_id' => 2 , 'expired_at'=>now()]);
        GroupUser::factory()->create(['user_id'=> 1 , 'group_id' => 2 , 'expired_at'=>now()]);
        GroupUser::factory()->create(['user_id'=> 1 , 'group_id' => 1 , 'expired_at'=>now('+6')]);
    }
}
