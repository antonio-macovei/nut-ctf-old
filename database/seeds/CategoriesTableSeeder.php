<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['name' => 'Web Vulnerabilities', 'short_name' => 'web'],
            ['name' => 'Binary Exploitation', 'short_name' => 'binary'],
            ['name' => 'Network Challenges', 'short_name' => 'network'],
            ['name' => 'Cryptography', 'short_name' => 'crypto'],
            ['name' => 'Open Source Intelligence', 'short_name' => 'osint'],
            ['name' => 'Miscellaneous Challenges', 'short_name' => 'misc'],
        ];

        foreach ($items as $item) {
            Category::updateOrCreate(['name' => $item['name']], $item);
        }
    }
}
