<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\TrainingPart;

class Training extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'training_part_id',
        'name',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'part_id' => TrainingPart::class,
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
     * リレーション - training_contentsテーブル
     *
     * @return HasMany
     */
    public function trainingContents(): HasMany
    {
        return $this->hasMany(TrainingContent::class);
    }

    /**
     * リレーション - training_partsテーブル
     *
     * @return BelongsTo
     */
    public function trainingPart(): BelongsTo
    {
        return $this->belongsTo(TrainingPart::class);
    }
}
