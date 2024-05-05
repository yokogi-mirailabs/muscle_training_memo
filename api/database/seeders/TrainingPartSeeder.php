<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrainingPartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('training_parts')->insert([
            [
                'name' => '首',
            ],
            [
                'name' => '肩',
            ],
            [
                'name' => '胸',
            ],
            [
                'name' => '背中',
            ],
            [
                'name' => '腕',
            ],
            [
                'name' => '腹',
            ],
            [
                'name' => '脚',
            ],
            [
                'name' => '有酸素運動',
            ],
            [
                'name' => 'その他',
            ]
        ]);
    }
}
