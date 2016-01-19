<?php

namespace Adrenth\Thetvdb;

use Adrenth\Thetvdb\Exception\InvalidArgumentException;

/**
 * Class Series
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb
 */
class Series
{
    /** @type int */
    private $identifier;

    /** @type Language */
    private $language;

    /** @type string */
    private $name;

    /** @type string */
    private $banner;

    /** @type string */
    private $overview;

    /** @type \DateTime */
    private $firstAired;

    /** @type string */
    private $network;

    /** @type string */
    private $imdbId;

    /** @type string */
    private $zap2itId;

    /** @type Episode[] */
    private $episodes = [];

    /**
     * Get identifier
     *
     * @return int
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * Set identifier
     *
     * @param int $identifier
     * @return $this
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = (int) $identifier;
        return $this;
    }

    /**
     * Get language
     *
     * @return Language
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set language
     *
     * @param Language $language
     * @return $this
     */
    public function setLanguage(Language $language)
    {
        $this->language = $language;
        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get banner
     *
     * @return string
     */
    public function getBanner()
    {
        return $this->banner;
    }

    /**
     * Set banner
     *
     * @param string $banner
     * @return $this
     */
    public function setBanner($banner)
    {
        $this->banner = $banner;
        return $this;
    }

    /**
     * Get overview
     *
     * @return string
     */
    public function getOverview()
    {
        return $this->overview;
    }

    /**
     * Set overview
     *
     * @param string $overview
     * @return $this
     */
    public function setOverview($overview)
    {
        $this->overview = $overview;
        return $this;
    }

    /**
     * Get firstAired
     *
     * @return \DateTime
     */
    public function getFirstAired()
    {
        return $this->firstAired;
    }

    /**
     * Set firstAired
     *
     * @param \DateTime $firstAired
     * @return $this
     */
    public function setFirstAired(\DateTime $firstAired)
    {
        $this->firstAired = $firstAired;
        return $this;
    }

    /**
     * Get network
     *
     * @return string
     */
    public function getNetwork()
    {
        return $this->network;
    }

    /**
     * Set network
     *
     * @param string $network
     * @return $this
     */
    public function setNetwork($network)
    {
        $this->network = $network;
        return $this;
    }

    /**
     * Get imdbId
     *
     * @return string
     */
    public function getImdbId()
    {
        return $this->imdbId;
    }

    /**
     * Set imdbId
     *
     * @param string $imdbId
     * @return $this
     */
    public function setImdbId($imdbId)
    {
        $this->imdbId = $imdbId;
        return $this;
    }

    /**
     * Get zap2itId
     *
     * @return string
     */
    public function getZap2itId()
    {
        return $this->zap2itId;
    }

    /**
     * Set zap2itId
     *
     * @param string $zap2itId
     * @return $this
     */
    public function setZap2itId($zap2itId)
    {
        $this->zap2itId = $zap2itId;
        return $this;
    }

    /**
     * Get episodes
     *
     * @return Episode[]
     */
    public function getEpisodes()
    {
        return $this->episodes;
    }

    /**
     * Set array of episodes
     *
     * @param Episode[] $episodes
     * @return $this
     * @throws InvalidArgumentException
     */
    public function setEpisodes($episodes)
    {
        if (!($episodes instanceof \ArrayAccess)) {
            throw new InvalidArgumentException('Episodes should be instance of ArrayAccess');
        }

        $this->episodes = $episodes;
        return $this;
    }

    /**
     * Add one episode to episodes array
     *
     * @param Episode $episode
     * @return $this
     */
    public function addEpisode(Episode $episode)
    {
        $this->episodes[] = $episode;
        return $this;
    }
}
