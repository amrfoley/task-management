<?php

namespace App\Enums;

enum TaskStatus: string
{
    case 1 = 'to-do';
    case 2 = 'pending';
    case 3 = 'in-progress';
    case 4 = 'testing';
    case 5 = 'cancelled';
    case 6 = 'resolved';
    case 7 = 'completed';
    case 8 = 'deployed';
}