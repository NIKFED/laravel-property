<?php

declare(strict_types=1);

namespace App\Enums;

enum RoomEnum: string
{
    case ROOM = 'room';
    case BEDROOM = 'bedroom';
    case BATHROOM = 'bathroom';
    case GARAGE = 'garage';
    case KITCHEN = 'kitchen';
}
