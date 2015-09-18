<?php

namespace Adrenth\Thetvdb;

/**
 * Class XmlResponseHandler
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb
 */
abstract class XmlResponseHandler implements ResponseHandlerInterface
{
    /**
     * XML data
     *
     * @type string
     */
    protected $xml;

    /**
     * Construct
     *
     * @param string $xml XML data
     */
    public function __construct($xml)
    {
        $this->xml = $xml;
    }

    /**
     * @inheritdoc
     */
    abstract public function handle();
}
