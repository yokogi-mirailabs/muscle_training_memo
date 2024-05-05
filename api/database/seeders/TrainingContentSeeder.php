<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Training;
use App\Models\TrainingContent;

class TrainingContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::findOrFail(1);

        $trainigs = Training::query()
            ->where('user_id', null)
            ->get()
            ->each(function (Training $training) use ($user) {
                TrainingContent::factory()->create([
                    'user_id' => $user->id,
                    'training_id' => $training->id,
                ]);
            });
    }
}
