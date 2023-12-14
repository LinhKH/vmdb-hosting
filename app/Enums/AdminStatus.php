<?php

namespace App\Enums;

class AdminStatus 
{
    public const NORMAL = 'N';
    public const QUIT = 'Q';

    protected static $descriptions = [
        self::NORMAL => '通常',
        self::QUIT => '停止'
    ];

    
}