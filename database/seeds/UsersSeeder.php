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
            "password" => bcrypt('password'),
            "hobbies" => serialize([
                "Soccer",
                "Game",
                "Watching"
            ]),
            "phone" => "9999999999",
            "country_id" => 2
        ]);
    }
}
