<?php

namespace Adrenth\Thetvdb\Response\Handler;

use Adrenth\Thetvdb\Exception\InvalidXmlInResponseException;
use Adrenth\Thetvdb\Language;
use Adrenth\Thetvdb\Response\SeriesResponse;
use Adrenth\Thetvdb\Series;
use Adrenth\Thetvdb\XmlResponseHandler;

/**
 * Class SeriesResponseHandler
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb\Response\Handler
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb
 */
class SeriesResponseHandler extends XmlResponseHandler
{
    /**
     * {@inheritdoc}
     *
     * @return SeriesResponse
     * @throws InvalidXmlInResponseException
     */
    public function handle()
    {
        $data = $this->getData('Data');

        if (!is_array($data)) {
            throw new InvalidXmlInResponseException('Invalid XML in response');
        }

        if (!array_key_exists('Series', $data)) {
            return new SeriesResponse();
        }

        $keys = array_keys($data['Series']);

        $series = [];

        if (is_numeric($keys[0])) {
            foreach ($data['Series'] as $seriesData) {
                $series[] = $this->getSeriesFromArray($seriesData);
            }
        } else {
            $series[] = $this->getSeriesFromArray($data['Series']);
        }

        return $series;
    }

    /**
     * @param array $data
     * @return Series
     */
    private function getSeriesFromArray(array $data)
    {
        $series = new Series();

        if (array_key_exists('seriesid', $data)) {
            $series->setIdentifier($data['seriesid']);
        }

        if (array_key_exists('language', $data)) {
            $series->setLanguage(new Language($data['language']));
        }

        if (array_key_exists('SeriesName', $data)) {
            $series->setName($data['SeriesName']);
        }

        if (array_key_exists('banner', $data)) {
            $series->setBanner($data['banner']);
        }

        if (array_key_exists('Overview', $data)) {
            $series->setOverview($data['Overview']);
        }

        if (array_key_exists('FirstAired', $data)) {
            $series->setFirstAired(new \DateTime(date('Y-m-d', strtotime($data['FirstAired']))));
        }

        if (array_key_exists('Network', $data)) {
            $series->setNetwork($data['Network']);
        }

        if (array_key_exists('IMDB_ID', $data)) {
            $series->setImdbId($data['IMDB_ID']);
        }

        if (array_key_exists('zap2it_id', $data)) {
            $series->setZap2itId($data['zap2it_id']);
        }

        return $series;
    }
}
