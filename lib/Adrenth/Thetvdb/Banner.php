<?php

namespace Adrenth\Thetvdb;

/**
 * Class Banner
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb
 * @author   Stanislav Vetlovskiy <mrerliz@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb
 */
class Banner
{
    // size in bannerType2 property
    const TYPE_FANART = 'fanart';
    // size in bannerType2 property
    const TYPE_POSTER = 'poster';
    // size: 400x578
    const TYPE_SEASON = 'season';
    // size: 758x140
    const TYPE_SERIES = 'series';

    /** @var int */
    private $identifier;

    /** @var string */
    private $bannerPath;

    /** @var string */
    private $bannerType;

    /** @var string */
    private $bannerType2;

    /** @var array[] */
    private $colors;

    /** @var string */
    private $language;

    /** @var float */
    private $rating;

    /** @var int */
    private $ratingCount;

    /** @var string */
    private $seriesName;

    /** @var int */
    private $season;

    /** @var string */
    private $thumbnailPath;

    /** @var string */
    private $vignettePath;

    /**
     * @return int
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * @param int $identifier
     *
     * @return $this
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = (int) $identifier;

        return $this;
    }

    /**
     * @return string
     */
    public function getBannerPath()
    {
        return $this->bannerPath;
    }

    /**
     * @param string $bannerPath
     *
     * @return $this
     */
    public function setBannerPath($bannerPath)
    {
        $this->bannerPath = $bannerPath;

        return $this;
    }

    /**
     * @return string
     */
    public function getBannerType()
    {
        return $this->bannerType;
    }

    /**
     * @param string $bannerType
     *
     * @return $this
     */
    public function setBannerType($bannerType)
    {
        $this->bannerType = $bannerType;

        return $this;
    }

    /**
     * @return string
     */
    public function getBannerType2()
    {
        return $this->bannerType2;
    }

    /**
     * @param string $bannerType2
     *
     * @return $this
     */
    public function setBannerType2($bannerType2)
    {
        $this->bannerType2 = $bannerType2;

        return $this;
    }

    /**
     * @return array[]
     */
    public function getColors()
    {
        return $this->colors;
    }

    /**
     * @param array[] $colors
     *
     * @return $this
     */
    public function setColors($colors)
    {
        $newColors = [];
        if (strlen($colors)) {
            foreach (explode('|', $colors) as $color) {
                $newColors[] = explode(',', $color);
            }
        }
        $this->colors = $newColors;

        return $this;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string $language
     *
     * @return $this
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @return float
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param float $rating
     *
     * @return $this
     */
    public function setRating($rating)
    {
        $this->rating = (float) $rating;

        return $this;
    }

    /**
     * @return int
     */
    public function getRatingCount()
    {
        return $this->ratingCount;
    }

    /**
     * @param int $ratingCount
     *
     * @return $this
     */
    public function setRatingCount($ratingCount)
    {
        $this->ratingCount = (int) $ratingCount;

        return $this;
    }

    /**
     * @return string
     */
    public function getSeriesName()
    {
        return $this->seriesName;
    }

    /**
     * @param string $seriesName
     *
     * @return $this
     */
    public function setSeriesName($seriesName)
    {
        $this->seriesName = $seriesName;

        return $this;
    }

    /**
     * @return int
     */
    public function getSeason()
    {
        return $this->season;
    }

    /**
     * @param int $season
     *
     * @return $this
     */
    public function setSeason($season)
    {
        $this->season = (int) $season;

        return $this;
    }

    /**
     * @return string
     */
    public function getThumbnailPath()
    {
        return $this->thumbnailPath;
    }

    /**
     * @param string $thumbnailPath
     *
     * @return $this
     */
    public function setThumbnailPath($thumbnailPath)
    {
        $this->thumbnailPath = $thumbnailPath;

        return $this;
    }

    /**
     * @return string
     */
    public function getVignettePath()
    {
        return $this->vignettePath;
    }

    /**
     * @param string $vignettePath
     *
     * @return $this
     */
    public function setVignettePath($vignettePath)
    {
        $this->vignettePath = $vignettePath;

        return $this;
    }

    /**
     * Get full banner url
     *
     * @return string
     */
    public function getFullBannerUrl()
    {
        return strlen($this->bannerPath) ? static::getBannersPath() . $this->bannerPath : null;
    }

    /**
     * Get full vignette url
     *
     * @return string
     */
    public function getFullVignetteUrl()
    {
        return strlen($this->vignettePath) ? static::getBannersPath() . $this->vignettePath : null;
    }

    /**
     * Get full thumbnail url
     *
     * @return string
     */
    public function getFullThumbnailUrl()
    {
        return strlen($this->thumbnailPath) ? static::getBannersPath() . $this->thumbnailPath : null;
    }

    /**
     * Get URI for full banner path
     *
     * @return string
     */
    private static function getBannersPath()
    {
        return Client::API_BASE_URI . '/banners/';
    }
}
