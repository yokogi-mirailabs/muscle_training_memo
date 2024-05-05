<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TrainingContent extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'training_id',
        'weight',
        'reps',
        'sets',
        'training_date',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'training_id' => 'integer',
        'weight' => 'float',
        'reps' => 'integer',
        'sets' => 'integer',
        'training_date' => 'date:Y-m-d',
    ];

    /**
     * リレーション - usersテーブル
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * リレーション - trainingテーブル
     *
     * @return BelongsTo
     */
    public function training(): BelongsTo
    {
        return $this->belongsTo(Training::class);
    }
}
