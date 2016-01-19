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
     * {@inheritdoc}
     *
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

        return static::getEpisodeFromArray($data['Episode']);
    }

    /**
     * Return Episode instance from array data
     *
     * @param array $data
     * @return Episode
     */
    public static function getEpisodeFromArray(array $data)
    {
        $episode = new Episode();

        if (array_key_exists('id', $data)) {
            $episode->setIdentifier($data['id']);
        }
        if (array_key_exists('seriesid', $data)) {
            $episode->setSeriesIdentifier($data['seriesid']);
        }
        if (array_key_exists('seasonid', $data)) {
            $episode->setSeasonIdentifier($data['seasonid']);
        }
        if (array_key_exists('Combined_episodenumber', $data)) {
            $episode->setCombinedEpisodeNumber($data['Combined_episodenumber']);
        }
        if (array_key_exists('Combined_season', $data)) {
            $episode->setCombinedSeason($data['Combined_season']);
        }
        if (array_key_exists('DVD_chapter', $data)) {
            $episode->setDvdChapter($data['DVD_chapter']);
        }
        if (array_key_exists('DVD_chapter', $data)) {
            $episode->setDvdDiscId($data['DVD_chapter']);
        }
        if (array_key_exists('DVD_episodenumber', $data)) {
            $episode->setDvdEpisodeNumber($data['DVD_episodenumber']);
        }
        if (array_key_exists('DVD_season', $data)) {
            $episode->setDvdSeason($data['DVD_season']);
        }
        if (array_key_exists('Director', $data)) {
            $episode->setDirector($data['Director']);
        }
        if (array_key_exists('EpImgFlag', $data)) {
            $episode->setImageFlag($data['EpImgFlag']);
        }
        if (array_key_exists('EpisodeName', $data)) {
            $episode->setName($data['EpisodeName']);
        }
        if (array_key_exists('EpisodeNumber', $data)) {
            $episode->setNumber($data['EpisodeNumber']);
        }
        if (array_key_exists('FirstAired', $data)) {
            $firstAired = strtotime($data['FirstAired']);
            $firstAired = $firstAired !== false ? new \DateTime(date('Y-m-d', $firstAired)) : null;
            $episode->setFirstAired($firstAired);
        }
        if (array_key_exists('GuestStars', $data)) {
            $episode->setGuestStars($data['GuestStars']);
        }
        if (array_key_exists('IMDB_ID', $data)) {
            $episode->setImdbId($data['IMDB_ID']);
        }
        if (array_key_exists('Language', $data)) {
            $episode->setLanguage(new Language($data['Language']));
        }
        if (array_key_exists('Overview', $data)) {
            $episode->setOverview($data['Overview']);
        }
        if (array_key_exists('ProductionCode', $data)) {
            $episode->setProductionCode($data['ProductionCode']);
        }
        if (array_key_exists('Rating', $data)) {
            $episode->setRating($data['Rating']);
        }
        if (array_key_exists('SeasonNumber', $data)) {
            $episode->setSeasonNumber($data['SeasonNumber']);
        }
        if (array_key_exists('Writer', $data)) {
            $episode->setWriters($data['Writer']);
        }
        if (array_key_exists('absolute_number', $data)) {
            $episode->setAbsoluteNumber($data['absolute_number']);
        }
        if (array_key_exists('filename', $data)) {
            $episode->setFilename($data['filename']);
        }
        if (array_key_exists('lastupdated', $data)) {
            $episode->setLastUpdated(new \DateTime(date('Y-m-d H:i:s', $data['lastupdated'])));
        }

        return $episode;
    }
}
