<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seed = Faker::create('App\User');

        for($i=0; $i < 10; $i++) {
            DB::table('users')->insert([
                'firstname'     => $seed->firstName(),
                'lastname'      => $seed->lastName(),
                'email'         => $seed->email(),
                'password'      => Hash::make($seed->password()),
                'position'      => $seed->jobTitle(),
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now()
            ]);
        }
    }
}
