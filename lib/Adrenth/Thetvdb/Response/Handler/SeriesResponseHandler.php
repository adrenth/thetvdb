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
     * @inheritdoc
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
        return $series->setIdentifier($data['seriesid'])
            ->setLanguage(new Language($data['language']))
            ->setName($data['SeriesName'])
            ->setBanner($data['banner'])
            ->setOverview($data['Overview'])
            ->setFirstAired(new \DateTime(date('Y-m-d', strtotime($data['FirstAired']))))
            ->setNetwork($data['Network'])
            ->setImdbId($data['IMDB_ID'])
            ->setZap2itId($data['zap2it_id']);
    }
}
