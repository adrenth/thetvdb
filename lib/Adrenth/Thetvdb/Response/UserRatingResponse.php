<?php

namespace Adrenth\Thetvdb\Response;

use Adrenth\Thetvdb\ResponseInterface;

/**
 * Class UserRatingResponse
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb\Response
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb
 */
class UserRatingResponse implements ResponseInterface
{
    /** @type float */
    private $rating;

    /**
     * @param float $rating User Rating
     */
    public function __construct($rating)
    {
        $this->rating = (float)$rating;
    }

    /**
     * Get rating
     *
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }
}
