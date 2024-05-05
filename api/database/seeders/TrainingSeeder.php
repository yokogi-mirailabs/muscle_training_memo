<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Enums\TrainingPart;

class TrainingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();
        DB::table('trainings')->insert([
            [
                'user_id' => null,
                'training_part_id' => 1,
                'name' => 'ネックプレス',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => null,
                'training_part_id' => 1,
                'name' => 'ネックプレス2',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => null,
                'training_part_id' => 2,
                'name' => 'ショルダープレス',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => null,
                'training_part_id' => 3,
                'name' => 'ベンチプレス',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => null,
                'training_part_id' => 4,
                'name' => 'デッドリフト',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => null,
                'training_part_id' => 5,
                'name' => 'バーベルカール',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => null,
                'training_part_id' => 6,
                'name' => '腹筋ローラー',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => null,
                'training_part_id' => 7,
                'name' => 'スクワット',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => null,
                'training_part_id' => 8,
                'name' => 'ランニング',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => null,
                'training_part_id' => 9,
                'name' => 'ストレッチ',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
