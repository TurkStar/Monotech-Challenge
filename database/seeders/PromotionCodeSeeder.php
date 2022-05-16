<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PromotionCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\Promotion::create([
            'code' => 'ABC123FDOPA3',
            'start_date' => '2022-12-18 18:30',
            'end_date' => '2022-12-18 18:30',
            'amount' => 100,
            'quota' => 50
         ]);
    }
}
