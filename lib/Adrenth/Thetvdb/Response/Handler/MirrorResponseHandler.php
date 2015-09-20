<?php


namespace Adrenth\Thetvdb\Response\Handler;

use Adrenth\Thetvdb\Exception\InvalidXmlInResponseException;
use Adrenth\Thetvdb\Mirror;
use Adrenth\Thetvdb\Response\MirrorResponse;
use Adrenth\Thetvdb\XmlResponseHandler;

/**
 * Class MirrorResponseHandler
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb\Response\Handler
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb
 */
class MirrorResponseHandler extends XmlResponseHandler
{
    /**
     * @inheritdoc
     * @return MirrorResponse
     * @throws InvalidXmlInResponseException
     */
    public function handle()
    {
        $data = $this->getData('Mirrors');

        if (!is_array($data)) {
            throw new InvalidXmlInResponseException('Invalid XML in response');
        }

        $mirrors = [];

        foreach ($data as $mirror) {
            $mirrors[] = new Mirror($mirror['id'], $mirror['mirrorpath'], $mirror['typemask']);
        }

        return new MirrorResponse($mirrors);
    }
}
