<?php

namespace Adrenth\Tests\Thetvdb\Client;

use ReflectionClass;

/**
 * Class ClientTest
 * @author Stanislav Vetlovskiy
 * @package Adrenth\Tests\Thetvdb\Client
 */
class ClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    public function apiPathDataProvider()
    {
        return [
            [
                '/api/#apikey#/series/#seriesId#/all/#language#.xml',
                ['apikey' => '1q2w3e4r', 'seriesId' => 10005, 'language' => 'en'],
                '/api/1q2w3e4r/series/10005/all/en.xml',
            ],
            [
                '#seriesId#/#apikey#/#language#/file.json',
                ['apikey' => '008', 'seriesId' => '12', 'language' => 'ru'],
                '12/008/ru/file.json',
            ],
            [
                '/#first-param#/#secondParam#/#third_param#/#fourthparam#',
                ['first-param' => 1, 'secondParam' => 2, 'third_param' => 3, 'fourthparam' => 4],
                '/1/2/3/4',
            ],
            [
                '#first-param##secondParam##third_param#',
                ['first-param' => '1', 'secondParam' => 2, 'third_param' => '3'],
                '123',
            ],
            [
                '/api/apikey/series/seriesId/all/language.xml',
                ['apikey' => '1q2w3e4r', 'seriesId' => 10005, 'language' => 'en'],
                '/api/apikey/series/seriesId/all/language.xml',
            ],
            [
                '/api/apikey/series/seriesId/all/language.xml',
                [],
                '/api/apikey/series/seriesId/all/language.xml',
            ],
            [
                '',
                ['apikey' => '1q2w3e4r', 'seriesId' => 10005, 'language' => 'en'],
                '',
            ],
            [
                '',
                [],
                '',
            ],
        ];
    }

    /**
     * @dataProvider apiPathDataProvider
     *
     * @param string $path
     * @param array  $options
     * @param string $expected
     */
    public function testGenerateApiPath($path, array $options, $expected)
    {
        $method = self::getMethod('generateApiPath');
        self::assertEquals($expected, $method->invokeArgs(null, [$path, $options]));
    }

    /**
     * @expectedException              \Adrenth\Thetvdb\Exception\InvalidArgumentException
     * @expectedExceptionMessageRegExp #Not found.*?additional#
     */
    public function testGenerateApiPathException()
    {
        $method = self::getMethod('generateApiPath');
        $method->invokeArgs(null, ['#key#/#additional#', ['key' => '1234']]);
    }

    /**
     * @param $name
     * @return \ReflectionMethod
     */
    protected static function getMethod($name)
    {
        $class = new ReflectionClass('\Adrenth\Thetvdb\Client');
        $method = $class->getMethod($name);
        $method->setAccessible(true);

        return $method;
    }
}
