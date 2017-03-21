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
            ['name' => 'Correos de Chile', 'label' => 'correos'],
            ['name' => 'Chilexpress', 'label' => 'chilexpress'],
            ['name' => 'Starken', 'label' => 'starken'],
            ['name' => 'DHL', 'label' => 'dhl'],
            ['name' => 'Groupon', 'label' => 'groupon'],
            ['name' => 'Blue Express', 'label' => 'blue']
        ];

        foreach($platforms as $platform) {
            PostalPlatform::create($platform);
        }
    }
}
