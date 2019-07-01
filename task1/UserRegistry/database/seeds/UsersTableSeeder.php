<?php

use Illuminate\Database\Seeder;

class UserListingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\UserListing::class, 7)->create();
    }
}
