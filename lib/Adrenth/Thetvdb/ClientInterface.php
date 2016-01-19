<?php

namespace Adrenth\Thetvdb;

use Adrenth\Thetvdb\Exception\InvalidArgumentException;
use Adrenth\Thetvdb\Exception\InvalidXmlInResponseException;
use Adrenth\Thetvdb\Response\SeriesResponse;
use Adrenth\Thetvdb\Response\ServerTimeResponse;
use Adrenth\Thetvdb\Response\UserFavoritesResponse;
use Adrenth\Thetvdb\Response\UserPreferredLanguageResponse;
use Adrenth\Thetvdb\Response\UserRatingResponse;
use Adrenth\Thetvdb\Response\UserRatingsResponse;

/**
 * Class ClientInterface
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb
 */
interface ClientInterface
{
    /**
     * Get Server Time (last Updated)
     *
     * @return ServerTimeResponse
     * @throws InvalidXmlInResponseException
     */
    public function getServerTime();

    /**
     * Get Series
     *
     * @param string        $name     Search query; exact match returns 1 result
     * @param Language|null $language Language
     * @return SeriesResponse
     * @throws InvalidXmlInResponseException
     */
    public function getSeries($name, Language $language = null);

    /**
     * Get one Series by TheTVDB ID
     *
     * @param integer       $id
     * @param Language|null $language
     * @return Response\SeriesResponse
     * @throws InvalidXmlInResponseException|InvalidArgumentException
     */
    public function getSeriesById($id, Language $language = null);

    /**
     * Get Series by IMDB ID
     *
     * @param string        $imdbId
     * @param Language|null $language
     * @return SeriesResponse
     * @throws InvalidXmlInResponseException
     */
    public function getSeriesByImdbId($imdbId, Language $language = null);

    /**
     * Get Series by ZAP2IT ID
     *
     * @param string        $zap2itId
     * @param Language|null $language
     * @return SeriesResponse
     * @throws InvalidXmlInResponseException
     */
    public function getSeriesByZap2itId($zap2itId, Language $language = null);

    /**
     * Get Episode by air date
     *
     * @param int           $seriesId
     * @param \DateTime     $airDate
     * @param Language|null $language
     * @return Response\EpisodeResponse
     * @throws InvalidXmlInResponseException
     */
    public function getEpisodeByAirDate($seriesId, \DateTime $airDate, Language $language = null);

    /**
     * Get User Preferred Languag
     *
     * @param string $accountId
     * @return UserPreferredLanguageResponse
     * @throws InvalidXmlInResponseException
     */
    public function getUserPreferredLanguage($accountId);

    /**
     * Get User Favorites
     *
     * Caution: This method returns a cached response from Server. If you need the actual list of favorites
     * after adding or removing series to favorites use that response instead.
     *
     * @param string $accountId Account Identifier
     * @return UserFavoritesResponse
     * @throws InvalidXmlInResponseException
     */
    public function getUserFavorites($accountId);

    /**
     * Add User Favorite Series
     *
     * @param string $accountId Account Identifier
     * @param int    $seriesId  Series Identifier
     * @return UserFavoritesResponse
     * @throws InvalidXmlInResponseException
     */
    public function addUserFavorite($accountId, $seriesId);

    /**
     * Remove User Favorite Series
     *
     * @param string $accountId Account Identifier
     * @param int    $seriesId  Series Identifier
     * @return UserFavoritesResponse
     * @throws InvalidXmlInResponseException
     */
    public function removeUserFavorite($accountId, $seriesId);

    /**
     * Get Ratings for User
     *
     * @param int      $accountId
     * @param int|null $seriesId
     * @return UserRatingsResponse
     * @throws InvalidXmlInResponseException
     */
    public function getRatingsForUser($accountId, $seriesId = null);

    /**
     * Add User Rating for Episode with given Episode Identifier
     *
     * @param string $accountId Account Identifier
     * @param int    $episodeId Episode Identifier
     * @param int    $rating    Rating 1 - 10
     * @return UserRatingResponse
     * @throws InvalidXmlInResponseException
     */
    public function addUserRatingForEpisode($accountId, $episodeId, $rating);

    /**
     * Add User Rating for Series with given Series Identifier
     *
     * @param string $accountId Account Identifier
     * @param int    $seriesId  Series Identifier
     * @param int    $rating    Rating 1 - 10
     * @return UserRatingResponse
     * @throws InvalidXmlInResponseException
     */
    public function addUserRatingForSeries($accountId, $seriesId, $rating);

    /**
     * Remove User Rating for Episode with given Episode Identifier
     *
     * @param string $accountId Account Identifier
     * @param int    $episodeId Episode Identifier
     * @return UserRatingResponse
     * @throws InvalidXmlInResponseException
     */
    public function removeUserRatingForEpisode($accountId, $episodeId);

    /**
     * Remove User Rating for Series with given Series Identifier
     *
     * @param string $accountId Account Identifier
     * @param int    $seriesId  Series Identifier
     * @return UserRatingResponse
     * @throws InvalidXmlInResponseException
     */
    public function removeUserRatingForSeries($accountId, $seriesId);
}
