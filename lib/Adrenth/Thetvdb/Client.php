<?php

namespace Adrenth\Thetvdb;

use Adrenth\Thetvdb\Exception\InvalidXmlInResponseException;
use Adrenth\Thetvdb\Response\Handler\MirrorResponseHandler;
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

        $this->initialDatabaseProcessing();
    }

    /**
     * Step 1: Get a list of mirrors
     *
     * a. Retrieve http://thetvdb.com/api/<apikey>/mirrors.xml.
     * b. Create 3 arrays called xmlmirrors, bannermirrors, and zipmirrors.
     * c. Separate the mirrors using the typemask field, as documented for mirrors.xml.
     * d. Select a random mirror from each array (denoted as <mirrorpath_xml>, <mirrorpath_banners>, and
     *    <mirrorpath_zip> for rest of example.
     *
     * @throws \RuntimeException
     */
    protected function initialDatabaseProcessing()
    {
        //$mirrors = $this->getMirrors();
        //var_dump($mirrors);
    }

    /**
     * @return Mirror[]
     * @throws \RuntimeException
     * @throws InvalidXmlInResponseException
     */
    protected function getMirrors()
    {
        $xml = $this->performApiCallWithXmlResponse('/api/' . $this->apiKey . '/mirrors.xml', true);
        $handler = new MirrorResponseHandler($xml);
        $response = $handler->handle();
        return $response->getMirrors();
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
     * @param string $path         API path (use constants e.g. Client::API_PATH_*)
     * @param bool   $cacheForever Cache response forever (on success)
     * @return string
     * @throws \RuntimeException
     */
    protected function performApiCallWithXmlResponse($path, $cacheForever = false)
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
