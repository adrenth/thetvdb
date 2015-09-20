<?php

namespace Adrenth\Thetvdb\Response;

use Adrenth\Thetvdb\Language;
use Adrenth\Thetvdb\ResponseInterface;

/**
 * Class UserPreferredLanguageResponse
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb\Response
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb
 */
class UserPreferredLanguageResponse implements ResponseInterface
{
    /** @type Language */
    private $language;

    /**
     * @param Language $language
     */
    public function __construct(Language $language)
    {
        $this->language = $language;
    }

    /**
     * Get language
     *
     * @return Language
     */
    public function getLanguage()
    {
        return $this->language;
    }
}
