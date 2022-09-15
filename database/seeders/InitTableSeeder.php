<?php
namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InitTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Super Admin',
            'password' => bcrypt('111111'),
            'email' => 'admin@admin.com',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $faker = Factory::create();
        for ($i = 1; $i < 200; $i ++) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'password' => bcrypt('password' . $i),
                'email' => $faker->unique()->email,
                'created_at' => $faker->dateTime(),
                'updated_at' => $faker->dateTime()
            ]);
        }
    }
}