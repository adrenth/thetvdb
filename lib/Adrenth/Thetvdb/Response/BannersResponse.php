<?php

namespace Adrenth\Thetvdb\Response;

use Adrenth\Thetvdb\Banner;

/**
 * Class SeriesResponse
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb\Response
 * @author   Stanislav Vetlovskiy <mrerliz@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb
 */
class BannersResponse
{
    /** @type Banner[] */
    private $banners;

    /**
     * @param Banner[] $banners
     */
    public function __construct(array $banners = [])
    {
        $this->banners = $banners;
    }

    /**
     * Get series
     *
     * @return Banner[]
     */
    public function getBanners()
    {
        return $this->banners;
    }
}
