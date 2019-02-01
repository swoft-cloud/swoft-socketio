<?php

namespace Swoft\SocketIO;

use Swoft\App;
use Swoft\WebSocket\Server\Storage\AbstractStorage;
use Swoft\WebSocket\Server\WebSocketServer;
use Swoft\Annotation\Bean;

/**
 * Class SocketIO
 * @package Swoft\SocketIO
 * @Bean("socketio")
 */
class SocketIO
{
    const NAME = 'socketIO';

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
     * @var int
     */
    private $sender;

    /**
     * @var array
     */
    private $rooms = [];

    /**
     * @var array
     */
    private $roomsForSend = [];

    /** @var AbstractStorage store */
    protected $storage;

    /**
     * SocketIO constructor.
     * @param int $sender
     */
    public function __construct(int $sender = 0)
    {
        $this->sender = $sender;
    }

    /**
     * @param int $sender Sender fd
     * @return $this
     */
    public function from(int $sender): self
    {
        return $this->setSender($sender);
    }

    /**
     * 加入分组（一个连接可以加入多个分组）
     * @param string $room
     * @return SocketIO
     */
    public function join(string $room): self
    {
        $this->rooms[] = $room;

        return $this;
    }

    /**
     * 离开分组（连接断开时会自动从分组中离开）
     * @param string $room
     * @return SocketIO
     */
    public function leave(string $room): self
    {
        $this->rooms[] = $room;

        return $this;
    }

    /**
     * send message to there are room(s), except sender.
     * @param array ...$rooms
     * @return $this
     */
    public function to(...$rooms): self
    {
        return $this;
    }

    /**
     * send message to there are room(s), include sender.
     * @param mixed ...$rooms
     * @return $this
     */
    public function in(...$rooms): self
    {
        return $this;
    }

    /**
     * @un-complete
     * @param string $path route path(socketIO's namespace)
     * @return $this
     */
    public function of(string $path): self
    {
       return $this;
    }

    /**
     * @param string $event
     * @param mixed $data
     */
    public function emit(string $event, $data)
    {
        \ws()->push($this->sender, $data);

        $this->reset();
    }

    public function send()
    {
        $this->reset();
    }

    public function reset()
    {

    }

    /**
     * @return int
     */
    public function getSender(): int
    {
        return $this->sender;
    }

    /**
     * @param int $sender
     * @return $this
     */
    public function setSender(int $sender): self
    {
        $this->sender = $sender;

        return $this;
    }
}
