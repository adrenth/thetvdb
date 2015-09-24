<?php

namespace Adrenth\Thetvdb\Response\Handler;

use Adrenth\Thetvdb\Episode;
use Adrenth\Thetvdb\Exception\InvalidXmlInResponseException;
use Adrenth\Thetvdb\Language;
use Adrenth\Thetvdb\Response\EpisodeResponse;
use Adrenth\Thetvdb\XmlResponseHandler;

/**
 * Class EpisodeResponseHandler
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb\Response\Handler
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb
 */
class EpisodeResponseHandler extends XmlResponseHandler
{
    /**
     * @inheritdoc
     * @return EpisodeResponse
     * @throws InvalidXmlInResponseException
     */
    public function handle()
    {
        $data = $this->getData('Data');

        if (!is_array($data)) {
            throw new InvalidXmlInResponseException('Invalid XML in response');
        }

        if (!array_key_exists('Episode', $data)) {
            return new EpisodeResponse();
        }

        return $this->getEpisodeFromArray($data['Episode']);
    }

    /**
     * @param array $data
     * @return Episode
     */
    private function getEpisodeFromArray(array $data)
    {
        $firstAired = strtotime(@$data['FirstAired']);
        $firstAired = $firstAired !== false ? new \DateTime(date('Y-m-d', $firstAired)) : '';

        $episode = new Episode();
        return $episode->setIdentifier(@$data['seriesid'])
            ->setSeasonIdentifier(@$data['seasonid'])
            ->setCombinedEpisodeNumber(@$data['Combined_episodenumber'])
            ->setCombinedSeason(@$data['Combined_season'])
            ->setDvdChapter(@$data['DVD_chapter'])
            ->setDvdDiscId(@$data['DVD_chapter'])
            ->setDvdEpisodeNumber(@$data['DVD_episodenumber'])
            ->setDvdSeason(@$data['DVD_season'])
            ->setDirector(@$data['Director'])
            ->setImageFlag(@$data['EpImgFlag'])
            ->setName(@$data['EpisodeName'])
            ->setNumber(@$data['EpisodeNumber'])
            ->setFirstAired($firstAired)
            ->setGuestStars(@$data['GuestStars'])
            ->setImdbId(@$data['IMDB_ID'])
            ->setLanguage(new Language(@$data['Language']))
            ->setOverview(@$data['Overview'])
            ->setProductionCode(@$data['ProductionCode'])
            ->setRating(@$data['Rating'])
            ->setSeasonNumber(@$data['SeasonNumber'])
            ->setWriters(@$data['Writer'])
            ->setAbsoluteNumber(@$data['absolute_number'])
            ->setFilename(@$data['filename'])
            ->setLastUpdated(new \DateTime(date('Y-m-d H:i:s', @$data['lastupdated'])));
    }
}
