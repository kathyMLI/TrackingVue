<?php

use Illuminate\Database\Seeder;
use App\Subscription;


class SubscriptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subscription::create([
            'name' => 'Gratis',
            'quantity' => 50
        ]);

    }
}
