<?php

namespace Adrenth\Thetvdb\Response\Handler;

use Adrenth\Thetvdb\Response\ServerTimeResponse;
use Adrenth\Thetvdb\XmlResponseHandler;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;
use Adrenth\Thetvdb\Exception\InvalidXmlInResponseException;

class ServerTimeResponseHandler extends XmlResponseHandler
{
    /**
     * @inheritdoc
     * @return ServerTimeResponse
     * @throws InvalidXmlInResponseException
     */
    public function handle()
    {
        $encoder = new XmlEncoder('Mirrors');

        try {
            $data = $encoder->decode($this->xml, 'xml');
        } catch (UnexpectedValueException $e) {
            throw new InvalidXmlInResponseException($e->getMessage());
        }

        if (!is_array($data) || !array_key_exists('Time', $data)) {
            throw new InvalidXmlInResponseException('Invalid XML in response');
        }

        return new ServerTimeResponse($data['Time']);
    }
}
