<?php

namespace Adrenth\Thetvdb\Response\Handler;

use Adrenth\Thetvdb\EpisodeRating;
use Adrenth\Thetvdb\Exception\InvalidXmlInResponseException;
use Adrenth\Thetvdb\Response\UserRatingsResponse;
use Adrenth\Thetvdb\SeriesRating;
use Adrenth\Thetvdb\XmlResponseHandler;

/**
 * Class UserRatingsResponseHandler
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb\Response\Handler
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb
 */
class UserRatingsResponseHandler extends XmlResponseHandler
{
    /**
     * {@inheritdoc}
     * @return UserRatingsResponse
     * @throws InvalidXmlInResponseException
     */
    public function handle()
    {
        $data = $this->getData('Data');

        if (!is_array($data)) {
            throw new InvalidXmlInResponseException('Invalid XML in response');
        }

        if (!array_key_exists('Series', $data)) {
            return new UserRatingsResponse();
        }

        $keys = array_keys($data['Series']);

        $ratings = [];

        if (is_numeric($keys[0])) {
            foreach ($data['Series'] as $rating) {
                $ratings[] = new SeriesRating(
                    $rating['seriesid'],
                    $rating['UserRating'],
                    $rating['CommunityRating']
                );
            }
        } else {
            $ratings[] = new SeriesRating(
                $data['Series']['seriesid'],
                $data['Series']['UserRating'],
                $data['Series']['CommunityRating']
            );
        }

        if (!array_key_exists('Episode', $data)) {
            return new UserRatingsResponse($ratings);
        }

        foreach ($data['Episode'] as $rating) {
            $ratings[] = new EpisodeRating(
                $rating['id'],
                $rating['UserRating'],
                $rating['CommunityRating']
            );
        }

        return new UserRatingsResponse($ratings);
    }
}
