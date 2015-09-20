<?php

namespace Adrenth\Thetvdb;

use Adrenth\Thetvdb\Exception\InvalidXmlInResponseException;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;

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

    /**
     * @param $rootNodeName
     * @return array|mixed|string
     * @throws InvalidXmlInResponseException
     */
    protected function getData($rootNodeName)
    {
        $encoder = new XmlEncoder($rootNodeName);

        try {
            $data = $encoder->decode($this->xml, 'xml');
        } catch (UnexpectedValueException $e) {
            throw new InvalidXmlInResponseException($e->getMessage());
        }

        return $data;
    }
}
