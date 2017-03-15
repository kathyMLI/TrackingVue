<?php

use Illuminate\Database\Seeder;
use App\PostalPlatform;

class PostalPlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $platforms = [
            ['name' => 'Correos de Chile'],
            ['name' => 'Chilexpress'],
            ['name' => 'Starken'],
            ['name' => 'DHL'],
            ['name' => 'Groupon'],
            ['name' => 'Blue Express']
        ];

        foreach($platforms as $platform) {
            PostalPlatform::create($platform);
        }
    }
}
