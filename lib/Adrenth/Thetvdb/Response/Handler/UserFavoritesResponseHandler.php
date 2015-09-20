<?php

namespace Adrenth\Thetvdb\Response\Handler;

use Adrenth\Thetvdb\Exception\InvalidXmlInResponseException;
use Adrenth\Thetvdb\Response\UserFavoritesResponse;
use Adrenth\Thetvdb\XmlResponseHandler;

/**
 * Class UserFavoritesResponseHandler
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb
 */
class UserFavoritesResponseHandler extends XmlResponseHandler
{
    /**
     * @inheritdoc
     * @return UserFavoritesResponse
     * @throws InvalidXmlInResponseException
     */
    public function handle()
    {
        $data = $this->getData('Favorites');

        if (!is_array($data) || !array_key_exists('Series', $data)) {
            throw new InvalidXmlInResponseException('Invalid XML in response');
        }

        $seriesIds = [];

        // Contains 1 item
        if (!is_array($data['Series']) && $data['Series'] !== '') {
            $seriesIds[] = (int)$data['Series'];
            return new UserFavoritesResponse($seriesIds);
        } elseif ($data['Series'] === '') {
            return new UserFavoritesResponse();
        }

        // Contains multiple items
        foreach ($data['Series'] as $seriesId) {
            if ($seriesId !== '') {
                $seriesIds[] = (int)$seriesId;
            }
        }

        return new UserFavoritesResponse($seriesIds);
    }
}
