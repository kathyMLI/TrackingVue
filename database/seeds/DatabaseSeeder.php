<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SubscriptionsSeeder::class);
        $this->call(PermissionsAndRoleSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(PostalPlatformSeeder::class);
    }
}
