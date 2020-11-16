<?php

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::create([
            'name' => 'United Kingdom'
        ]);
        Country::create([
            'name' => 'China'
        ]);
        Country::create([
            'name' => 'United States'
        ]);
    }
}
