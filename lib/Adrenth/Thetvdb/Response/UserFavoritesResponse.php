<?php

namespace Adrenth\Thetvdb\Response;

use Adrenth\Thetvdb\ResponseInterface;

/**
 * Class UserFavoritesResponse
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb\Response
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb
 */
class UserFavoritesResponse implements ResponseInterface
{
    /** @type array */
    private $seriesIds;

    /**
     * @param array $seriesIds
     */
    public function __construct(array $seriesIds = [])
    {
        $this->seriesIds = $seriesIds;
    }

    /**
     * Get seriesIds
     *
     * @return array
     */
    public function getSeriesIds()
    {
        return $this->seriesIds;
    }
}
