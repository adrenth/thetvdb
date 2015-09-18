<?php

namespace Adrenth\Thetvdb;

use Adrenth\Thetvdb\Exception\InvalidXmlInResponseException;
use Adrenth\Thetvdb\Response\Handler\MirrorResponseHandler;
use Adrenth\Thetvdb\Response\Handler\ServerTimeResponseHandler;
use Adrenth\Thetvdb\Response\MirrorResponse;
use Adrenth\Thetvdb\Response\ServerTimeResponse;
use Doctrine\Common\Cache\Cache;
use GuzzleHttp\Client as HttpClient;

/**
 * Class Client
 *
 * @category Tvrage
 * @package  Adrenth\Thetvdb
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb
 */
class Client implements ClientInterface
{
    const API_BASE_URI = 'http://thetvdb.com';

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
        $xml = $this->performApiCallWithCachedXmlResponse('/api/' . $this->apiKey . '/mirrors.xml', true);
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
        $xml = $this->performApiCallWithXmlResponse('/api/Updates.php?type=none');
        $handler = new ServerTimeResponseHandler($xml);
        return $handler->handle();
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
     * @param $path
     * @return string
     * @throws \RuntimeException
     */
    protected function performApiCallWithXmlResponse($path)
    {
        $response = $this->httpClient->get($path);

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
     * @param string $path
     * @param bool   $cacheForever Cache response forever (on success)
     * @return string
     * @throws \RuntimeException
     */
    protected function performApiCallWithCachedXmlResponse($path, $cacheForever = false)
    {
        $cacheKey = md5($path);

        if ($this->cache->contains($cacheKey)) {
            return $this->cache->fetch($cacheKey);
        }

        $response = $this->httpClient->get($path);

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
