<?php
declare(strict_types=1);

namespace App\Services\GeoCoder;

use App\Services\Response\ServiceResponseInteface;

/**
 * Interface GeoCoderInterface
 * @package App\Services\GeoCoder
 */
interface GeoCoderInterface
{

    /**
     * @param string $lat
     * @param string $long
     * @return ServiceResponseInteface
     */
    public function getGeoCode(string $lat, string $long): ServiceResponseInteface;
}