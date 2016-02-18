<?php

namespace Adrenth\Thetvdb\Response\Handler;

use Adrenth\Thetvdb\Banner;
use Adrenth\Thetvdb\Exception\InvalidXmlInResponseException;
use Adrenth\Thetvdb\Language;
use Adrenth\Thetvdb\Response\BannersResponse;
use Adrenth\Thetvdb\XmlResponseHandler;

/**
 * Class SeriesResponseHandler
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb\Response\Handler
 * @author   Stanislav Vetlovskiy <mrerliz@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb
 */
class BannersResponseHandler extends XmlResponseHandler
{
    /**
     * {@inheritdoc}
     *
     * @return BannersResponse
     * @throws InvalidXmlInResponseException
     */
    public function handle()
    {
        $data = $this->getData('Data');

        if (!is_array($data)) {
            throw new InvalidXmlInResponseException('Invalid XML in response');
        }

        if (!array_key_exists('Banner', $data)) {
            return new BannersResponse();
        }

        $keys = array_keys($data['Banner']);

        $banners = [];

        if (is_numeric($keys[0])) {
            foreach ($data['Banner'] as $bannerData) {
                $banners[] = $this->getBannerFromArray($bannerData);
            }
        }

        return new BannersResponse($banners);
    }

    /**
     * @param array $data
     *
     * @return Banner
     */
    private function getBannerFromArray(array $data)
    {
        $series = new Banner();

        if (array_key_exists('id', $data)) {
            $series->setIdentifier($data['id']);
        }

        if (array_key_exists('BannerPath', $data)) {
            $series->setBannerPath($data['BannerPath']);
        }
        if (array_key_exists('BannerType', $data)) {
            $series->setBannerType($data['BannerType']);
        }
        if (array_key_exists('BannerType2', $data)) {
            $series->setBannerType2($data['BannerType2']);
        }
        if (array_key_exists('Colors', $data)) {
            $series->setColors($data['Colors']);
        }
        if (array_key_exists('Language', $data)) {
            $series->setLanguage(new Language($data['Language']));
        }
        if (array_key_exists('Rating', $data)) {
            $series->setRating($data['Rating']);
        }
        if (array_key_exists('RatingCount', $data)) {
            $series->setRatingCount($data['RatingCount']);
        }
        if (array_key_exists('SeriesName', $data)) {
            $series->setSeriesName($data['SeriesName']);
        }
        if (array_key_exists('Season', $data)) {
            $series->setSeason($data['Season']);
        }
        if (array_key_exists('ThumbnailPath', $data)) {
            $series->setThumbnailPath($data['ThumbnailPath']);
        }
        if (array_key_exists('VignettePath', $data)) {
            $series->setVignettePath($data['VignettePath']);
        }


        return $series;
    }
}
