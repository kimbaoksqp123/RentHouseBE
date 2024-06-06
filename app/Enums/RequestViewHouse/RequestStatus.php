<?php

namespace App\Enums\RequestViewHouse;

enum RequestStatus: int
{
    case Pending = 1;
    case Approved = 2;
    case Rejected = 3;
    case Canceled = 5;
}
