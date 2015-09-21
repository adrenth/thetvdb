<?php

namespace Adrenth\Thetvdb;

/**
 * Class Language
 *
 * @see http://www.thetvdb.com/wiki/index.php?title=API:languages.xml
 *      The languages.xml file holds a list of all of the languages available on this website.
 *      NOTE: Previous interfaces primarily used the language id for lookups. This new API uses the 2 character
 *      abbreviation. This file will rarely change, so you may consider hard-coding these values into your program
 *      and updating them only with new releases.
 *      In addition to the two letter abbreviations the word "all" can be used as a language option within the API to
 *      get information in all languages.
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb
 */
class Language
{
    /** @type int */
    private $identifier;

    /** @type string */
    private $code;

    /** @type string */
    private $label;

    /** @type array */
    private static $languages = [
        'en' => [
            'label' => 'English',
            'id' => 7
        ],
        'sv' => [
            'label' => 'Svenska',
            'id' => 8,
        ],
        'no' => [
            'label' => 'Norsk',
            'id' => 9,
        ],
        'da' => [
            'label' => 'Dansk',
            'id' => 10,
        ],
        'fi' => [
            'label' => 'Suomeksi',
            'id' => 11,
        ],
        'nl' => [
            'label' => 'Nederlands',
            'id' => 13,
        ],
        'de' => [
            'label' => 'Deutsch',
            'id' => 14,
        ],
        'it' => [
            'label' => 'Italiano',
            'id' => 15,
        ],
        'es' => [
            'label' => 'Español',
            'id' => 16,
        ],
        'fr' => [
            'label' => 'Français',
            'id' => 17,
        ],
        'pl' => [
            'label' => 'Polski',
            'id' => 18,
        ],
        'hu' => [
            'label' => 'Magyar',
            'id' => 19,
        ],
        'el' => [
            'label' => 'Greek',
            'id' => 20,
        ],
        'tr' => [
            'label' => 'Turkish',
            'id' => 21,
        ],
        'ru' => [
            'label' => 'Russian',
            'id' => 22,
        ],
        'he' => [
            'label' => 'Hebrew',
            'id' => 24,
        ],
        'ja' => [
            'label' => 'Japanese',
            'id' => 25,
        ],
        'pt' => [
            'label' => 'Portuguese',
            'id' => 26,
        ],
        'zh' => [
            'label' => 'Chinese',
            'id' => 27,
        ],
        'cs' => [
            'label' => 'Czech',
            'id' => 28,
        ],
        'sl' => [
            'label' => 'Slovenian',
            'id' => 30,
        ],
        'hr' => [
            'label' => 'Croatian',
            'id' => 31,
        ],
        'ko' => [
            'label' => 'Korean',
            'id' => 32,
        ],
    ];

    /**
     * @param string $code Language code e.g en
     */
    public function __construct($code = null)
    {
        if ($code === null || !array_key_exists($code, self::$languages)) {
            $code = 'en';
        }

        $this->code = $code;
        $this->label = self::$languages[$code]['label'];
        $this->identifier = self::$languages[$code]['id'];
    }

    /**
     * Get identifier
     *
     * @return int
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Get Language by ID
     *
     * @param int $identifier
     * @return Language
     * @throws \InvalidArgumentException
     */
    public static function getByIdentifier($identifier)
    {
        $keys = array_keys(self::$languages);
        $key = array_search($identifier, array_column(self::$languages, 'id'), true);

        if ($key === false) {
            return new \InvalidArgumentException('Language ID not found');
        }

        return new self($keys[$key]);
    }
}
