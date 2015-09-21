<?php

namespace Adrenth\Thetvdb;

use Adrenth\Thetvdb\Exception\InvalidXmlInResponseException;
use Adrenth\Thetvdb\Response\Handler\MirrorResponseHandler;
use Adrenth\Thetvdb\Response\Handler\ServerTimeResponseHandler;
use Adrenth\Thetvdb\Response\Handler\UserFavoritesResponseHandler;
use Adrenth\Thetvdb\Response\Handler\UserPreferredLanguageResponseHandler;
use Adrenth\Thetvdb\Response\Handler\UserRatingResponseHandler;
use Adrenth\Thetvdb\Response\Handler\UserRatingsResponseHandler;
use Adrenth\Thetvdb\Response\MirrorResponse;
use Adrenth\Thetvdb\Response\ServerTimeResponse;
use Adrenth\Thetvdb\Response\UserFavoritesResponse;
use Adrenth\Thetvdb\Response\UserPreferredLanguageResponse;
use Adrenth\Thetvdb\Response\UserRatingResponse;
use Doctrine\Common\Cache\Cache;
use GuzzleHttp\Client as HttpClient;

/**
 * Class Client
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb
 */
class Client implements ClientInterface
{
    const API_BASE_URI = 'http://thetvdb.com';
    const API_PATH_SERVER_TIME = '/api/Updates.php';
    const API_PATH_USER_LANGUAGE = '/api/User_PreferredLanguage.php';
    const API_PATH_USER_FAVORITES = '/api/User_Favorites.php';
    const API_PATH_USER_RATING = '/api/User_Rating.php';
    const API_PATH_USER_RATINGS = '/api/GetRatingsForUser.php';

    /**
     * HTTP Client
     *
     * @type HttpClient
     */
    private $httpClient;

    /**
     * Cache
     *
     * @type Cache
     */
    private $cache;

    /**
     * Cache TTL in seconds
     *
     * @type int
     */
    private $cacheTtl = 86400;

    /**
     * API Key
     *
     * @see http://thetvdb.com/?tab=apiregister
     * @type string
     */
    private $apiKey;

    /**
     * Construct
     *
     * @param string $apiKey
     * @param Cache  $cache
     * @throws \RuntimeException
     */
    public function __construct(Cache $cache, $apiKey)
    {
        $this->cache = $cache;
        $this->apiKey = $apiKey;
        $this->init();
    }

    /**
     * Initialize Client
     *
     * @return void
     * @throws \RuntimeException
     */
    public function init()
    {
        $this->httpClient = new HttpClient(
            [
                'base_uri' => self::API_BASE_URI
            ]
        );
    }

    /**
     * Get Server Time (last Updated)
     *
     * @return ServerTimeResponse
     * @throws \RuntimeException
     * @throws InvalidXmlInResponseException
     */
    public function getServerTime()
    {
        $xml = $this->performApiCallWithXmlResponse(static::API_PATH_SERVER_TIME, [
            'query' => [
                'type' => 'none'
            ]
        ]);
        $handler = new ServerTimeResponseHandler($xml);
        return $handler->handle();
    }

    /*
    public function getSeries($name, Language $language = null)
    {

    }

    public function getSeriesByRemoteId($imdbId, $zap2itId, Language $language = null)
    {

    }

    public function getEpisodeByAirDate($seriesId, \DateTime $airDate, Language $language = null)
    {
        // apikey
    }
    */

    /**
     * Get User Preferred Languag
     *
     * @param string $accountId
     * @return UserPreferredLanguageResponse
     * @throws \RuntimeException
     * @throws InvalidXmlInResponseException
     */
    public function getUserPreferredLanguage($accountId)
    {
        $xml = $this->performApiCallWithCachedXmlResponse(static::API_PATH_USER_LANGUAGE, [
            'query' => [
                'accountid' => $accountId
            ]
        ]);

        $handler = new UserPreferredLanguageResponseHandler($xml);
        return $handler->handle();
    }

    /**
     * Get User Favorites
     *
     * Caution: This method returns a cached response from Server. If you need the actual list of favorites
     * after adding or removing series to favorites use that response instead.
     *
     * @param string $accountId Account Identifier
     * @return UserFavoritesResponse
     * @throws \RuntimeException
     * @throws InvalidXmlInResponseException
     */
    public function getUserFavorites($accountId)
    {
        $xml = $this->performApiCallWithXmlResponse(static::API_PATH_USER_FAVORITES, [
            'query' => [
                'accountid' => $accountId,
                'type' => 'none'
            ]
        ]);

        $handler = new UserFavoritesResponseHandler($xml);
        return $handler->handle();
    }

    /**
     * Add User Favorite Series
     *
     * @param string $accountId Account Identifier
     * @param int    $seriesId  Series Identifier
     * @return UserFavoritesResponse
     * @throws \RuntimeException
     * @throws InvalidXmlInResponseException
     */
    public function addUserFavorite($accountId, $seriesId)
    {
        $xml = $this->performApiCallWithXmlResponse(static::API_PATH_USER_FAVORITES, [
            'query' => [
                'accountid' => $accountId,
                'seriesid' => (int)$seriesId,
                'type' => 'add'
            ]
        ]);

        $handler = new UserFavoritesResponseHandler($xml);
        return $handler->handle();
    }

    /**
     * Remove User Favorite Series
     *
     * @param string $accountId Account Identifier
     * @param int    $seriesId  Series Identifier
     * @return UserFavoritesResponse
     * @throws \RuntimeException
     * @throws InvalidXmlInResponseException
     */
    public function removeUserFavorite($accountId, $seriesId)
    {
        $xml = $this->performApiCallWithXmlResponse(static::API_PATH_USER_FAVORITES, [
            'query' => [
                'accountid' => $accountId,
                'seriesid' => (int)$seriesId,
                'type' => 'remove'
            ]
        ]);

        $handler = new UserFavoritesResponseHandler($xml);
        return $handler->handle();
    }

    public function getRatingsForUser($accountId, $seriesId = null)
    {
        $seriesId = ($seriesId === null) ? '' : (int)$seriesId;

        $xml = $this->performApiCallWithXmlResponse(static::API_PATH_USER_RATINGS, [
            'query' => [
                'apikey' => $this->apiKey,
                'accountid' => $accountId,
                'seriesid' => $seriesId,
            ]
        ]);

        var_dump($xml);

        $handler = new UserRatingsResponseHandler($xml);
        return $handler->handle();
    }

    /**
     * Add User Rating for Episode with given Episode Identifier
     *
     * @param string $accountId Account Identifier
     * @param int    $episodeId Episode Identifier
     * @param int    $rating    Rating 1 - 10
     * @return UserRatingResponse
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     * @throws InvalidXmlInResponseException
     */
    public function addUserRatingForEpisode($accountId, $episodeId, $rating)
    {
        $rating = (int)$rating;

        if (!($rating >= 1 && $rating <= 10)) {
            throw new \InvalidArgumentException('Invalid rating, must be an integer value from 1 to 10');
        }

        $xml = $this->performUserRating($accountId, 'episode', (int)$episodeId, $rating);

        $handler = new UserRatingResponseHandler($xml);
        return $handler->handle();
    }

    /**
     * Add User Rating for Series with given Series Identifier
     *
     * @param string $accountId Account Identifier
     * @param int    $seriesId  Series Identifier
     * @param int    $rating    Rating 1 - 10
     * @return UserRatingResponse
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     * @throws InvalidXmlInResponseException
     */
    public function addUserRatingForSeries($accountId, $seriesId, $rating)
    {
        $rating = (int)$rating;

        if (!($rating >= 1 && $rating <= 10)) {
            throw new \InvalidArgumentException('Invalid rating, must be an integer value from 1 to 10');
        }

        $xml = $this->performUserRating($accountId, 'series', (int)$seriesId, $rating);

        $handler = new UserRatingResponseHandler($xml);
        return $handler->handle();
    }

    /**
     * Remove User Rating for Episode with given Episode Identifier
     *
     * @param string $accountId Account Identifier
     * @param int    $episodeId Episode Identifier
     * @return UserRatingResponse
     * @throws \RuntimeException
     * @throws InvalidXmlInResponseException
     */
    public function removeUserRatingForEpisode($accountId, $episodeId)
    {
        $xml = $this->performUserRating($accountId, 'episode', (int)$episodeId, 0);
        $handler = new UserRatingResponseHandler($xml);
        return $handler->handle();
    }

    /**
     * Remove User Rating for Series with given Series Identifier
     *
     * @param string $accountId Account Identifier
     * @param int    $seriesId  Series Identifier
     * @return UserRatingResponse
     * @throws \RuntimeException
     * @throws InvalidXmlInResponseException
     */
    public function removeUserRatingForSeries($accountId, $seriesId)
    {
        $xml = $this->performUserRating($accountId, 'series', (int)$seriesId, 0);
        $handler = new UserRatingResponseHandler($xml);
        return $handler->handle();
    }

    /**
     * Perform User Rating
     *
     * @param string $accountId Account Identifier
     * @param string $itemType  Enum Value 'series' or 'episode'
     * @param int    $itemId    Series Identifier of Episode Identifier
     * @param int    $rating    Rating 0 - 10
     * @return string
     * @throws \RuntimeException
     */
    private function performUserRating($accountId, $itemType, $itemId, $rating)
    {
        return $this->performApiCallWithXmlResponse(static::API_PATH_USER_RATING, [
            'query' => [
                'accountid' => $accountId,
                'itemtype' => $itemType,
                'itemid' => $itemId,
                'rating' => $rating
            ]
        ]);
    }

    /**
     * Set cacheTtl
     *
     * @param int $cacheTtl Cache TTL in seconds
     * @return $this
     */
    public function setCacheTtl($cacheTtl)
    {
        $this->cacheTtl = (int)$cacheTtl;
        return $this;
    }

    /**
     * Perform an API call
     *
     * @param string $path    Path
     * @param array  $options HTTP Client options
     * @return string
     * @throws \RuntimeException
     */
    protected function performApiCallWithXmlResponse($path, array $options = [])
    {
        $response = $this->httpClient->get($path, $options);

        if ($response->getStatusCode() === 200) {
            $xml = $response->getBody()->getContents();
            return $xml;
        }

        throw new \RuntimeException(
            sprintf(
                'Got status code %d from service at path %s',
                $response->getStatusCode(),
                $path
            )
        );
    }

    /**
     * Perform an API call (cached)
     *
     * @param string $path         Path
     * @param array  $options      HTTP Client options
     * @param bool   $cacheForever Cache response forever (on success)
     * @return string
     * @throws \RuntimeException
     */
    protected function performApiCallWithCachedXmlResponse($path, array $options = [], $cacheForever = false)
    {
        $cacheKey = md5($path);

        if ($this->cache->contains($cacheKey)) {
            return $this->cache->fetch($cacheKey);
        }

        $response = $this->httpClient->get($path, $options);

        if ($response->getStatusCode() === 200) {
            $xml = $response->getBody()->getContents();
            $this->cache->save($cacheKey, $xml, $cacheForever ? 0 : $this->cacheTtl);
            return $xml;
        }

        throw new \RuntimeException(
            sprintf(
                'Got status code %d from service at path %s',
                $response->getStatusCode(),
                $path
            )
        );
    }
}
