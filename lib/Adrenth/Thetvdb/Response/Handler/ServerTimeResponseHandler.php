<?php

namespace Adrenth\Thetvdb\Response\Handler;

use Adrenth\Thetvdb\Exception\InvalidXmlInResponseException;
use Adrenth\Thetvdb\Response\ServerTimeResponse;
use Adrenth\Thetvdb\XmlResponseHandler;

/**
 * Class ServerTimeResponseHandler
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb\Response\Handler
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb
 */
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
