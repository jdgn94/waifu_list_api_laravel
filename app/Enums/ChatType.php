<?php

namespace App\Enums;
enum ChatType: string
{
    case PRIVATE = 'private';
    case GROUP = 'group';
    case CHANNEL = 'channel';
    case SUPERGROUP = 'supergroup';
}
