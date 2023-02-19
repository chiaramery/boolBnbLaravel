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
            [
                'name' => 'sponsorizzazione di un giorno',
                'price' => 2.99,
                'time' => 1
            ],
            [
                'name' => 'sponsorizzazione di tre giorni',
                'price' => 5.99,
                'time' => 3
            ],
            [
                'name' => 'sponsorizzazione di sei giorni',
                'price' => 9.99,
                'time' => 6
            ],
        ];
        foreach ($promotions as $promotion) {
            $new_promotion = new Promotion();
            $new_promotion->name = $promotion['name'];
            $new_promotion->price = $promotion['price'];
            $new_promotion->time = $promotion['time'];
            // $new_promotion->slug = Str::slug($new_promotion->name, '-');
            $new_promotion->save();
        }
    }
}
