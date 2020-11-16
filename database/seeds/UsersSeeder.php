<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name" => "Ruyun Li",
            "email" => "admin1@admin.com",
            "password" => "password",
            "hobbies" => "test",
            "phone" => "123123123123123123",
            "country_id" => 11
        ]);
    }
}
