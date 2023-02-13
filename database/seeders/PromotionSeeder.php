<?php

namespace Database\Seeders;

use App\Models\Promotion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $promotions = [
            'Wifi',
            'Posto Macchina',
            'Piscina',
            'Portineria',
            'Sauna',
            'Vista Mare'
        ];
        foreach ($promotions as $promotion) {
            $new_promotion = new Promotion();
            $new_promotion->name = $promotion;
            $new_promotion->slug = Str::slug($new_promotion->name, '-');
            $new_promotion->save();
        }
    }
}
