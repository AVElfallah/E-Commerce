<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\GovSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\GovernoratesSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('1234')
        ]);
        $this->call(SettingSeeder::class);
$this->call(GovSeeder::class);

    }
}