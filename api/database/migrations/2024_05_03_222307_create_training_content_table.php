<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Training;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('training_contents', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete()->comment('ユーザーID');
            $table->foreignIdFor(Training::class)->constrained()->cascadeOnDelete()->comment('トレーニングID');
            $table->float('weight')->nullable()->comment('重量');
            $table->integer('reps')->comment('回数');
            $table->integer('sets')->comment('セット数');
            $table->date('training_date')->comment('トレーニング日');
            $table->datetimes();
            $table->softDeletesDatetime();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_content');
    }
};
