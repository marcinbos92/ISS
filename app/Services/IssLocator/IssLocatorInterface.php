<?php
declare(strict_types=1);


namespace App\Services\IssLocator;


use App\Services\IssLocator\Exceptions\NotDefinedLocatorPath;

/**
 * Interface IssLocatorInterface
 * @package App\Services\IssLocator
 */
interface IssLocatorInterface
{
    /**
     * @param int $satelliteId
     * @return IssResponseInteface
     */
    public function locate(int $satelliteId): IssResponseInteface;

    /**
     * @return string
     * @throws NotDefinedLocatorPath
     */
    public function getPath(): string;
}