<?php

namespace Adrenth\Thetvdb\Response\Handler;

use Adrenth\Thetvdb\Exception\InvalidXmlInResponseException;
use Adrenth\Thetvdb\Response\UserRatingResponse;
use Adrenth\Thetvdb\XmlResponseHandler;

/**
 * Class UserRatingResponseHandler
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb\Response\Handler
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb
 */
class UserRatingResponseHandler extends XmlResponseHandler
{
    /**
     * @inheritdoc
     * @return UserRatingResponse
     * @throws InvalidXmlInResponseException
     */
    public function handle()
    {
        $data = $this->getData('Data');

        if (!is_array($data)
            || (!array_key_exists('Episode', $data) && !array_key_exists('Series', $data))
        ) {
            throw new InvalidXmlInResponseException('Invalid XML in response');
        }

        if (array_key_exists('Series', $data) && array_key_exists('Rating', $data['Series'])) {
            return new UserRatingResponse($data['Series']['Rating']);
        }

        if (array_key_exists('Episode', $data) && array_key_exists('Rating', $data['Episode'])) {
            return new UserRatingResponse($data['Episode']['Rating']);
        }

        throw new InvalidXmlInResponseException('Invalid XML in response');
    }
}
