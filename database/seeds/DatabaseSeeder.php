<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 15; $i++) {
            DB::table('students')->insert([
                'name' => Str::random(10),
                'email' => "test" . $i . "@test.com",
                'address' => Str::random(30),
            ]);
        }
    }
}
