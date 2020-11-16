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
            "name" => "Super Admin",
            "email" => "admin@admin.com",
            "firstname" => "Super",
            "lastname" => "Admin",
            "password" => "password",
            "hobbies" => "test",
            "phone" => "9999999999",
            "country_id" => 2
        ]);
    }
}
