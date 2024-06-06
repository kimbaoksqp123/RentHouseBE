<?php

namespace App\Enums\House;

enum HouseType: int
{
    case Room = 1;
    case House = 2;
    case MiniApartment = 3;

    public function label(): string
    {
        return match($this) {
            self::Room => 'room',
            self::House => 'house',
            self::MiniApartment => 'mini apartment',
        };
    }
}
