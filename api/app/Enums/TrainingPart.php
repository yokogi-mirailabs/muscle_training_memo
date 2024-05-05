<?php

namespace App\Enums;

enum TrainingPart: int
{
    case NECK = 1;
    case SHOULDERS = 2;
    case CHEST = 3;
    case BACK = 4;
    case ARMS = 5;
    case LEGS = 6;
    case ABS = 7;
    case AEROBIC = 8;
    case OTHER = 99;

    public function label(): string
    {
        return match ($this) {
            self::NECK => '首',
            self::SHOULDERS => '肩',
            self::CHEST => '胸',
            self::BACK => '背中',
            self::ARMS => '腕',
            self::ABS => '腹',
            self::LEGS => '脚',
            self::AEROBIC => '有酸素運動',
            self::OTHER => 'その他',
        };
    }
}