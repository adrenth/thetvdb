<?php

namespace Adrenth\Thetvdb\Response;

use Adrenth\Thetvdb\Episode;

/**
 * Class EpisodeResponse
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb\Response
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb
 */
class EpisodeResponse
{
    /** @type Episode */
    private $episode;

    /**
     * @param Episode|null $episode
     */
    public function __construct(Episode $episode = null)
    {
        $this->episode = $episode;
    }

    /**
     * Get episode
     *
     * @return Episode
     */
    public function getEpisode()
    {
        return $this->episode;
    }
}
