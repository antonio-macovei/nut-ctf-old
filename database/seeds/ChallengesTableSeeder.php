<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Challenge;
use App\Models\Category;

class ChallengesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $categories = Category::all()->pluck('id')->toArray();

        $points = [100, 200, 300, 400, 500];
        $types = [1, 2, 3];

        for ($i = 0; $i < 10; $i++) {
           $item = ['name' => $faker->name,
                'description' => $faker->text($maxNbChars = 100),
                'flag' => 'NUT{'.Str::random(32).'}',
                'points' => Arr::random($points),
                'category_id' => $faker->randomElement($categories),
                'type' =>Arr::random($types),
                'availability' => now(),
                'created_at' => now(),
                'updated_at' => now()];
            Challenge::updateOrCreate(['name' => $item['name']], $item);
        }
    }
}
