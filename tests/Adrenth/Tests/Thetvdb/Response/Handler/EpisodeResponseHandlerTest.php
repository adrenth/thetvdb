<?php

namespace Adrenth\Tests\Thetvdb\Response\Handler;

use Adrenth\Thetvdb\Response\Handler\EpisodeResponseHandler;

/**
 * Class EpisodeResponseHandlerTest
 *
 * @author Stanislav Vetlovskiy
 * @package Adrenth\Tests\Thetvdb\Response\Handler
 */
class EpisodeResponseHandlerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider responseDataProvider
     *
     * @param array $data xml response data in array
     */
    public function testGetEpisodeFromArray(array $data)
    {
        $episode = EpisodeResponseHandler::getEpisodeFromArray($data);
        self::assertInstanceOf('Adrenth\\Thetvdb\\Episode', $episode);
    }

    /**
     * Data provider with response from tvdb
     *
     * @return array
     */
    public function responseDataProvider()
    {
        return [
            [[
                'id' => '4518979',
                'Combined_episodenumber' => '1',
                'Combined_season' => '0',
                'DVD_chapter' => '',
                'DVD_discid' => '',
                'DVD_episodenumber' => '',
                'DVD_season' => '',
                'Director' => '',
                'EpImgFlag' => '2',
                'EpisodeName' => 'Youchien 1',
                'EpisodeNumber' => '1',
                'FirstAired' => '',
                'GuestStars' => '',
                'IMDB_ID' => '',
                'Language' => 'en',
                'Overview' => '',
                'ProductionCode' => '',
                'Rating' => '',
                'RatingCount' => '0',
                'SeasonNumber' => '0',
                'Writer' => '',
                'absolute_number' => '',
                'airsafter_season' => '',
                'airsbefore_episode' => '',
                'airsbefore_season' => '',
                'filename' => 'episodes/257888/4518979.jpg',
                'lastupdated' => '1401954190',
                'seasonid' => '489449',
                'seriesid' => '257888',
                'thumb_added' => '',
                'thumb_height' => '225',
                'thumb_width' => '400',
            ]],
            [[
                'id' => '4301352',
                'Combined_episodenumber' => '4',
                'Combined_season' => '1',
                'DVD_chapter' => '',
                'DVD_discid' => '',
                'DVD_episodenumber' => '',
                'DVD_season' => '',
                'Director' => '',
                'EpImgFlag' => '2',
                'EpisodeName' => 'I Want to Catch You ⇔ Thrills in Love',
                'EpisodeNumber' => '4',
                'FirstAired' => '2012-04-27',
                'GuestStars' => '',
                'IMDB_ID' => '',
                'Language' => 'en',
                'Overview' => 'Part A: Due to a teachers\' meeting, afternoon club activities have been cancelled, so Mayoi announces a "Kick the Can" game, for which the students are divided into two teams: hiders and seekers with a special penality for the losing team. Part B: The school radio now turns into a school TV with special guests Io and Sakaki, who have to give advice to problems sent in by girl students.',
                'ProductionCode' => '',
                'Rating' => '10.0',
                'RatingCount' => '1',
                'SeasonNumber' => '1',
                'Writer' => '天河信彦',
                'absolute_number' => '4',
                'filename' => 'episodes/257888/4301352.jpg',
                'lastupdated' => '1364135173',
                'seasonid' => '489450',
                'seriesid' => '257888',
                'thumb_added' => '',
                'thumb_height' => '225',
                'thumb_width' => '400',
            ]]
        ];
    }
}

