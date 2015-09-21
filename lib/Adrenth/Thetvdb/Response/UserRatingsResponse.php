<?php

namespace Adrenth\Thetvdb\Response;

use Adrenth\Thetvdb\ResponseInterface;

/**
 * Class UserRatingsResponse
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb\Response
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb
 */
class UserRatingsResponse implements ResponseInterface
{
    /** @type array */
    private $ratings;

    /**
     * @param array $ratings
     */
    public function __construct(array $ratings = [])
    {
        $this->ratings = $ratings;
    }

    /**
     * Get ratings
     *
     * @return array
     */
    public function getRatings()
    {
        return $this->ratings;
    }
}
