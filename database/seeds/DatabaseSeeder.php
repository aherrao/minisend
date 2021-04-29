<?php

use Illuminate\Database\Seeder;
use Database\Seeders\EmailStatusTypesTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ClientTypesTableSeeder::class);
        $this->call(EmailStatusTypesTableSeeder::class);
        $this->call(InitiateProjectSeeder::class);
    }
}
