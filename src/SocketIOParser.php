<?php

namespace Swoft\SocketIO;

use Swoft\DataParser\AbstractDataParser;
use Swoft\Helper\JsonHelper;

/**
 * Class SocketIOParser
 * @package Swoft\SocketIO
 */
class SocketIOParser extends AbstractDataParser
{
    /**
     * the default data structure
     */
    const STRUCTURE = [
        'type' => '',
        'attachments' => '',
        'nsp' => '/',
        'id' => 0,
        'data' => []
    ];

    const ERROR = [
        'type' => Packet::ERROR,
        'data' => 'parse error',
    ];

    /**
     * @param mixed $data
     * @return string
     * @ref https://github.com/walkor/phpsocket.io
     */
    public function encode($data): string
    {
        $map = (array)$data;
        $map = \array_merge(self::STRUCTURE, $map);

        $type = (int)$map['type'];
        $encoded = $map['type'];
        $hasNsp = $map['nsp'] && $map['nsp'] !== '/';

        if ($type === Packet::BINARY_ACK || $type === Packet::BINARY_EVENT) {
            $encoded .= $map['attachments'] . '-';
        }

        if ($hasNsp) {
            $encoded .= $map['nsp'];
        }

        // if has nsp(excepted '/'), we append it followed by a comma `,`

        if ($map['id']) {
            if ($hasNsp) {
                $hasNsp = false;
                $encoded .= ',';
            }

            $encoded .= $map['id'];
        }

        if ($map['data']) {
            if ($hasNsp) {
                $encoded .= ',';
            }

            $encoded .= \json_encode($map['data']);
        }

        return $encoded;
    }

    /**
     * @param string $data
     * @return mixed
     */
    public function decode(string $data)
    {
        $str = \trim($data);

        // Not a json map string
        if ($str[0] !== '{') {
            $map = [
                'data' => $str
            ];
        } else {
            $map = JsonHelper::decode($data, true);
        }

        return $map;
    }
}
