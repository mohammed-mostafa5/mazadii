<?php

use App\Models\User;
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
        User::create([

            'name' => 'Ahmed Abdullah',
            'address' => 'Nasr-City, Cairo, Egypt',
            'area_id' => 1,
            'phone' => '01100547820',
            'email' => 'user@email.com',
            'password' => 'password',
            'start_as' => 'Owner Pet',
            'email_verified_at' => now(),
            'verify_code' => '1234',
            'gender' => 'Male',
            'about_me' => 'Back-end Developer',
            'status' => '1',

        ]);
    }
}
