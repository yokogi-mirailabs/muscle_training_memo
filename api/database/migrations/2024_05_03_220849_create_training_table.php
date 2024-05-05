<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
// use App\Enums\TrainingPart;
use App\Models\User;
use App\Models\TrainingPart;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->nullable()->constrained()->cascadeOnDelete()->comment('ユーザーID');
            $table->foreignIdFor(TrainingPart::class)->nullable()->constrained()->cascadeOnDelete()->comment('部位ID');
            $table->string('name')->comment('トレーニング名');
            $table->datetimes();
            $table->softDeletesDatetime();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training');
    }
};
