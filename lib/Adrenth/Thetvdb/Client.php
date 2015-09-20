<?php

namespace Adrenth\Thetvdb;

use Adrenth\Thetvdb\Exception\InvalidXmlInResponseException;
use Adrenth\Thetvdb\Response\Handler\MirrorResponseHandler;
use Adrenth\Thetvdb\Response\Handler\ServerTimeResponseHandler;
use Adrenth\Thetvdb\Response\Handler\UserFavoritesResponseHandler;
use Adrenth\Thetvdb\Response\Handler\UserPreferredLanguageResponseHandler;
use Adrenth\Thetvdb\Response\MirrorResponse;
use Adrenth\Thetvdb\Response\ServerTimeResponse;
use Adrenth\Thetvdb\Response\UserFavoritesResponse;
use Adrenth\Thetvdb\Response\UserPreferredLanguageResponse;
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
     * @return MirrorResponse
     * @throws \RuntimeException
     * @throws InvalidXmlInResponseException
     * @deprecated This is deprecated. It will return one mirror. Thetvdb.com staff handles it on their side.
     */
    public function getMirrors()
    {
        $xml = $this->performApiCallWithCachedXmlResponse('/api/' . $this->apiKey . '/mirrors.xml', [], true);
        $handler = new MirrorResponseHandler($xml);
        return $handler->handle();
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

    public function getRatingsForUser($accountId, $seriesId = null)
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

    /*
    public function addUserRatingForEpisode($accountId, $episodeId, $rating)
    {
        // rating 1 - 10 (not 0)
    }

    public function addUserRatingForSeries($accountId, $seriesId, $rating)
    {
        // rating 1 - 10 (not 0)
    }

    public function removeUserRatingForEpisode($accountId, $episodeId)
    {
        // rating = 0
    }

    public function removeUserRatingForSeries($accountId, $seriesId)
    {
        // rating = 0
    }
    */

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
