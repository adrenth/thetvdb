<?php

namespace Adrenth\Thetvdb;

/**
 * Class Rating
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb
 */
abstract class Rating
{
    /** @type int */
    private $identifier;

    /** @type int */
    private $userRating;

    /** @type float */
    private $communityRating;

    /**
     * @param int $identifier
     * @param int $userRating
     * @param float $communityRating
     */
    public function __construct($identifier, $userRating, $communityRating)
    {
        $this->identifier = (int)$identifier;
        $this->userRating = (int)$userRating;
        $this->communityRating = (float)$communityRating;
    }

    /**
     * Get Series Identifier
     *
     * @return int
     */
    public function getId()
    {
        return $this->identifier;
    }

    /**
     * Get User Rating
     *
     * @return int
     */
    public function getUserRating()
    {
        return $this->userRating;
    }

    /**
     * Get Community Rating
     *
     * @return float
     */
    public function getCommunityRating()
    {
        return $this->communityRating;
    }
}
