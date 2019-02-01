<?php

namespace Swoft\SocketIO;

/**
 * Class Packet
 * @package Swoft\SocketIO
 */
class Packet
{
    /*
        Packet#CONNECT (0)
        Packet#DISCONNECT (1)
        Packet#EVENT (2)
        Packet#ACK (3)
        Packet#ERROR (4)
        Packet#BINARY_EVENT (5)
        Packet#BINARY_ACK (6)
     */
    const CONNECT = 0;
    const DISCONNECT = 1;
    const EVENT = 2;
    const ACK = 3;
    const ERROR = 4;
    const BINARY_EVENT = 5;
    const BINARY_ACK = 6;

    /**
     * @var array
     */
    const SUPPORTED = [
        self::CONNECT => 1,
        self::DISCONNECT => 1,
        self::EVENT => 1,
        self::ACK => 1,
        self::ERROR => 1,
        self::BINARY_EVENT => 1,
        self::BINARY_ACK => 1,
    ];

    /**
     * @param int $type
     * @return bool
     */
    public static function isValid(int $type): bool
    {
        return isset(self::SUPPORTED[$type]);
    }
}
