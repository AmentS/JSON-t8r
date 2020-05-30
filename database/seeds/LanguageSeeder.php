<?php

use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Language::insert([
            ['code' => 'en', 'name' => 'English'],
            ['code' => 'sr', 'name' => 'Serbian'],
            ['code' => 'it', 'name' => 'Italian'],
            ['code' => 'ge', 'name' => 'German']
        ]);
    }
}
