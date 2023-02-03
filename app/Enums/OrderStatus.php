<?php

namespace App\Enums;

enum OrderStatus: string
{
    case Pending = 'pending';
    case ArriveAtWareHouse = 'arrive_at_warehouse';
    case InProduction = 'in_production';
    case Completed = 'completed';
    case PicksUp = 'picks_up';
}
