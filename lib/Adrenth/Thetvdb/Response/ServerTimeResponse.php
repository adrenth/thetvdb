<?php

namespace Adrenth\Thetvdb\Response;

use Adrenth\Thetvdb\ResponseInterface;

/**
 * Class ServerTimeResponse
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb\Response
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb
 */
class ServerTimeResponse implements ResponseInterface
{
    /** @type int */
    private $serverTime;

    /**
     * @param int $serverTime
     */
    public function __construct($serverTime)
    {
        $this->serverTime = (int) $serverTime;
    }

    /**
     * Get serverTime
     *
     * @return int
     */
    public function getServerTime()
    {
        return $this->serverTime;
    }
}
