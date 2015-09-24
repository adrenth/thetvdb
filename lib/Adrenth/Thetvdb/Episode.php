<?php

namespace Adrenth\Thetvdb;

/**
 * Class Episode
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb
 */
class Episode
{
    /** @type int */
    private $identifier;

    /** @type int */
    private $seasonIdentifier;

    /** @type int */
    private $seasonNumber;

    /** @type int */
    private $combinedEpisodeNumber;

    /** @type int */
    private $combinedSeason;

    /** @type string */
    private $dvdChapter;

    /** @type string */
    private $dvdDiscId;

    /** @type string */
    private $dvdEpisodeNumber;

    /** @type string */
    private $dvdSeason;

    /** @type string */
    private $director;

    /** @type int */
    private $imageFlag;

    /** @type string */
    private $name;

    /** @type int */
    private $number;

    /** @type \DateTime */
    private $firstAired;

    /** @type string */
    private $guestStars;

    /** @type string */
    private $imdbId;

    /** @type Language */
    private $language;

    /** @type string */
    private $overview;

    /** @type string */
    private $productionCode;

    /** @type string */
    private $rating;

    /** @type string */
    private $writers;

    /** @type string */
    private $absoluteNumber;

    /** @type string */
    private $filename;

    /** @type \DateTime */
    private $lastUpdated;

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
        $this->identifier = (int)$identifier;
        return $this;
    }

    /**
     * Get seasonIdentifier
     *
     * @return int
     */
    public function getSeasonIdentifier()
    {
        return $this->seasonIdentifier;
    }

    /**
     * Set seasonIdentifier
     *
     * @param int $seasonIdentifier
     * @return $this
     */
    public function setSeasonIdentifier($seasonIdentifier)
    {
        $this->seasonIdentifier = (int)$seasonIdentifier;
        return $this;
    }

    /**
     * Get seasonNumber
     *
     * @return int
     */
    public function getSeasonNumber()
    {
        return $this->seasonNumber;
    }

    /**
     * Set seasonNumber
     *
     * @param int $seasonNumber
     * @return $this
     */
    public function setSeasonNumber($seasonNumber)
    {
        $this->seasonNumber = (int)$seasonNumber;
        return $this;
    }

    /**
     * Get combinedEpisodeNumber
     *
     * @return int
     */
    public function getCombinedEpisodeNumber()
    {
        return $this->combinedEpisodeNumber;
    }

    /**
     * Set combinedEpisodeNumber
     *
     * @param int $combinedEpisodeNumber
     * @return $this
     */
    public function setCombinedEpisodeNumber($combinedEpisodeNumber)
    {
        $this->combinedEpisodeNumber = (int)$combinedEpisodeNumber;
        return $this;
    }

    /**
     * Get combinedSeason
     *
     * @return int
     */
    public function getCombinedSeason()
    {
        return $this->combinedSeason;
    }

    /**
     * Set combinedSeason
     *
     * @param int $combinedSeason
     * @return $this
     */
    public function setCombinedSeason($combinedSeason)
    {
        $this->combinedSeason = $combinedSeason;
        return $this;
    }

    /**
     * Get dvdChapter
     *
     * @return string
     */
    public function getDvdChapter()
    {
        return $this->dvdChapter;
    }

    /**
     * Set dvdChapter
     *
     * @param string $dvdChapter
     * @return $this
     */
    public function setDvdChapter($dvdChapter)
    {
        $this->dvdChapter = $dvdChapter;
        return $this;
    }

    /**
     * Get dvdDiscId
     *
     * @return string
     */
    public function getDvdDiscId()
    {
        return $this->dvdDiscId;
    }

    /**
     * Set dvdDiscId
     *
     * @param string $dvdDiscId
     * @return $this
     */
    public function setDvdDiscId($dvdDiscId)
    {
        $this->dvdDiscId = $dvdDiscId;
        return $this;
    }

    /**
     * Get dvdEpisodeNumber
     *
     * @return string
     */
    public function getDvdEpisodeNumber()
    {
        return $this->dvdEpisodeNumber;
    }

    /**
     * Set dvdEpisodeNumber
     *
     * @param string $dvdEpisodeNumber
     * @return $this
     */
    public function setDvdEpisodeNumber($dvdEpisodeNumber)
    {
        $this->dvdEpisodeNumber = $dvdEpisodeNumber;
        return $this;
    }

    /**
     * Get dvdSeason
     *
     * @return string
     */
    public function getDvdSeason()
    {
        return $this->dvdSeason;
    }

    /**
     * Set dvdSeason
     *
     * @param string $dvdSeason
     * @return $this
     */
    public function setDvdSeason($dvdSeason)
    {
        $this->dvdSeason = $dvdSeason;
        return $this;
    }

    /**
     * Get director
     *
     * @return string
     */
    public function getDirector()
    {
        return $this->director;
    }

    /**
     * Set director
     *
     * @param string $director
     * @return $this
     */
    public function setDirector($director)
    {
        $this->director = $director;
        return $this;
    }

    /**
     * Get imageFlag
     *
     * @return int
     */
    public function getImageFlag()
    {
        return $this->imageFlag;
    }

    /**
     * Set imageFlag
     *
     * @param int $imageFlag
     * @return $this
     */
    public function setImageFlag($imageFlag)
    {
        $this->imageFlag = (int)$imageFlag;
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
     * Get number
     *
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set number
     *
     * @param int $number
     * @return $this
     */
    public function setNumber($number)
    {
        $this->number = (int)$number;
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
    public function setFirstAired(\DateTime $firstAired = null)
    {
        $this->firstAired = $firstAired;
        return $this;
    }

    /**
     * Get guestStars
     *
     * @return string
     */
    public function getGuestStars()
    {
        return $this->guestStars;
    }

    /**
     * Set guestStars
     *
     * @param string $guestStars
     * @return $this
     */
    public function setGuestStars($guestStars)
    {
        $this->guestStars = $guestStars;
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
    public function setLanguage($language)
    {
        $this->language = $language;
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
     * Get productionCode
     *
     * @return string
     */
    public function getProductionCode()
    {
        return $this->productionCode;
    }

    /**
     * Set productionCode
     *
     * @param string $productionCode
     * @return $this
     */
    public function setProductionCode($productionCode)
    {
        $this->productionCode = $productionCode;
        return $this;
    }

    /**
     * Get rating
     *
     * @return string
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set rating
     *
     * @param string $rating
     * @return $this
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
        return $this;
    }

    /**
     * Get writers
     *
     * @return string
     */
    public function getWriters()
    {
        return $this->writers;
    }

    /**
     * Set writers
     *
     * @param string $writers
     * @return $this
     */
    public function setWriters($writers)
    {
        $this->writers = $writers;
        return $this;
    }

    /**
     * Get absoluteNumber
     *
     * @return string
     */
    public function getAbsoluteNumber()
    {
        return $this->absoluteNumber;
    }

    /**
     * Set absoluteNumber
     *
     * @param string $absoluteNumber
     * @return $this
     */
    public function setAbsoluteNumber($absoluteNumber)
    {
        $this->absoluteNumber = $absoluteNumber;
        return $this;
    }

    /**
     * Get filename
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set filename
     *
     * @param string $filename
     * @return $this
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * Get lastUpdated
     *
     * @return \DateTime
     */
    public function getLastUpdated()
    {
        return $this->lastUpdated;
    }

    /**
     * Set lastUpdated
     *
     * @param \DateTime $lastUpdated
     * @return $this
     */
    public function setLastUpdated($lastUpdated)
    {
        $this->lastUpdated = $lastUpdated;
        return $this;
    }
}
