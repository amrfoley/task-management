<?php

namespace App\Enums;

enum TaskStatus: int
{
    case ToDo = 1;
    case Pending = 2;
    case InProgress = 3;
    case Testing = 4;
    case Cancelled = 5;
    case Deployed = 6;
    case Completed = 7;
    case Resolved = 8;
}