<?php

namespace Adrenth\Thetvdb\Response;

use Adrenth\Thetvdb\ResponseInterface;

/**
 * Class MirrorResponse
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb\Response
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb
 */
class MirrorResponse implements ResponseInterface
{
    /** @type array */
    private $mirrors;

    /**
     * @param array $mirrors
     */
    public function __construct(array $mirrors = [])
    {
        $this->mirrors = $mirrors;
    }

    /**
     * Get mirrors
     *
     * @return array
     */
    public function getMirrors()
    {
        return $this->mirrors;
    }
}
