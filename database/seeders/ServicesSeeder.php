<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            'Wifi',
            'Posto Macchina',
            'Piscina',
            'Portineria',
            'Sauna',
            'Vista Mare'
        ];

        foreach ($services as $service) {
            $new_service = new Service();
            $new_service->name = $service;
            $new_service->slug = Str::slug($new_service->name, '-');
            $new_service->save();
        }
    }
}
