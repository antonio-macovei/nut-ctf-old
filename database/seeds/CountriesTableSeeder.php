<?php

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['name' => 'Romania', 'short_name' => 'ro'],
            ['name' => 'United States', 'short_name' => 'us'],
            ['name' => 'United Kingdom', 'short_name' => 'uk'],
            ['name' => 'France', 'short_name' => 'fr'],
        ];

        foreach ($items as $item) {
            Country::updateOrCreate(['name' => $item['name']], $item);
        }
    }
}
