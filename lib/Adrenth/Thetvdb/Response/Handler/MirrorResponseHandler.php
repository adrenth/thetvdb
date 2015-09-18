<?php


namespace Adrenth\Thetvdb\Response\Handler;

use Adrenth\Thetvdb\Exception\InvalidXmlInResponseException;
use Adrenth\Thetvdb\Mirror;
use Adrenth\Thetvdb\Response\MirrorResponse;
use Adrenth\Thetvdb\XmlResponseHandler;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;

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
        $encoder = new XmlEncoder('Mirrors');

        try {
            $data = $encoder->decode($this->xml, 'xml');
        } catch (UnexpectedValueException $e) {
            throw new InvalidXmlInResponseException($e->getMessage());
        }

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
