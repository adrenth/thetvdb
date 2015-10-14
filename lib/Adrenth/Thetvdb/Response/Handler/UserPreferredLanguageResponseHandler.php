<?php

namespace Adrenth\Thetvdb\Response\Handler;

use Adrenth\Thetvdb\Exception\InvalidXmlInResponseException;
use Adrenth\Thetvdb\Language;
use Adrenth\Thetvdb\Response\UserPreferredLanguageResponse;
use Adrenth\Thetvdb\XmlResponseHandler;

/**
 * Class UserPreferredLanguageResponseHandler
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb\Response\Handler
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb
 */
class UserPreferredLanguageResponseHandler extends XmlResponseHandler
{
    /**
     * {@inheritdoc}
     *
     * @return UserPreferredLanguageResponse
     * @throws InvalidXmlInResponseException
     */
    public function handle()
    {
        $data = $this->getData('Languages');

        if (!is_array($data) || !array_key_exists('Language', $data)) {
            throw new InvalidXmlInResponseException('Invalid XML in response');
        }

        $language = $data['Language'];
        $code = (!array_key_exists('abbreviation', $language)) ? 'en' : $language['abbreviation'];

        return new UserPreferredLanguageResponse(new Language($code));
    }
}
