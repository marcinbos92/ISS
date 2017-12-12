<?php
declare(strict_types=1);


namespace App\Services\IssLocator;


use App\Services\IssLocator\Exceptions\NotDefinedLocatorPath;
use App\Services\Response\ServiceResponseInteface;

/**
 * Interface IssLocatorInterface
 * @package App\Services\IssLocator
 */
interface IssLocatorInterface
{
    /**
     * @param int $satelliteId
     * @return ServiceResponseInteface
     */
    public function locate(int $satelliteId): ServiceResponseInteface;

    /**
     * @return string
     * @throws NotDefinedLocatorPath
     */
    public function getPath(): string;
}