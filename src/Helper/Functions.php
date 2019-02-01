<?php
/**
 * Created by PhpStorm.
 * User: inhere
 * Date: 2018/6/20
 * Time: 上午10:29
 */


if (!function_exists('sio')) {
    /**
     * @param int|null $fd
     * @return \Swoft\SocketIO\SocketIO
     */
    function sio(int $fd = null): \Swoft\SocketIO\SocketIO
    {
        return new \Swoft\SocketIO\SocketIO($fd);
    }
}
