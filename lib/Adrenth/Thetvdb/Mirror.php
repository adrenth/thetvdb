<?php

namespace Adrenth\Thetvdb;

/**
 * Class Mirror
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb
 */
class Mirror
{
    const MASK_XML = 1;
    const MASK_BANNER = 2;
    const MASK_ZIP = 4;

    /** @type int */
    private $identifier;

    /** @type string */
    private $mirrorPath;

    /** @type int */
    private $typeMask;

    /**
     * Mirror constructor.
     *
     * @param int    $identifier
     * @param string $mirrorPath
     * @param int    $typeMask
     */
    public function __construct($identifier, $mirrorPath, $typeMask)
    {
        $this->identifier = (int)$identifier;
        $this->mirrorPath = $mirrorPath;
        $this->typeMask = (int)$typeMask;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->identifier;
    }

    /**
     * Get mirrorPath
     *
     * @return string
     */
    public function getMirrorPath()
    {
        return $this->mirrorPath;
    }

    /**
     * Get typeMask
     *
     * @return int
     */
    public function getTypeMask()
    {
        return $this->typeMask;
    }
}
