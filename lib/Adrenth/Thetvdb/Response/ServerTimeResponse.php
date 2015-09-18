<?php

namespace Adrenth\Thetvdb\Response;

use Adrenth\Thetvdb\ResponseInterface;

class ServerTimeResponse implements ResponseInterface
{
    /** @type int */
    private $serverTime;

    /**
     * @param int $serverTime
     */
    public function __construct($serverTime)
    {
        $this->serverTime = (int)$serverTime;
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
