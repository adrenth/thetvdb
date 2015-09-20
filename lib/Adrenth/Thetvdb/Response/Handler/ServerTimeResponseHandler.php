<?php

namespace Adrenth\Thetvdb\Response\Handler;

use Adrenth\Thetvdb\Exception\InvalidXmlInResponseException;
use Adrenth\Thetvdb\Response\ServerTimeResponse;
use Adrenth\Thetvdb\XmlResponseHandler;

class ServerTimeResponseHandler extends XmlResponseHandler
{
    /**
     * @inheritdoc
     * @return ServerTimeResponse
     * @throws InvalidXmlInResponseException
     */
    public function handle()
    {
        $data = $this->getData('Items');

        if (!is_array($data) || !array_key_exists('Time', $data)) {
            throw new InvalidXmlInResponseException('Invalid XML in response');
        }

        return new ServerTimeResponse($data['Time']);
    }
}
