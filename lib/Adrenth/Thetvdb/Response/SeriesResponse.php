<?php

namespace Adrenth\Thetvdb\Response;

/**
 * Class SeriesResponse
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb\Response
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb
 */
class SeriesResponse
{
    /** @type array */
    private $series;

    /**
     * @param array $series
     */
    public function __construct(array $series = [])
    {
        $this->series = $series;
    }

    /**
     * Get series
     *
     * @return array
     */
    public function getSeries()
    {
        return $this->series;
    }
}
