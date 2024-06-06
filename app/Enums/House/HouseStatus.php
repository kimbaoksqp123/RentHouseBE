<?php

namespace App\Enums\House;

enum HouseStatus: int
{
    case Empty = 1;
    case Rent = 2;
    case Hidden = 3;
    case Lock = 4;

    public function label(): string
    {
        return match($this) {
            self::Empty => 'empty',
            self::Rent => 'rent',
            self::Hidden => 'hidden',
            self::Lock => 'lock',
        };
    }
}
