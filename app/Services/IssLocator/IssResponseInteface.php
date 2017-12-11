<?php
declare(strict_types=1);


namespace App\Services\IssLocator;


/**
 * Interface IssResponseInteface
 * @package App\Services\IssLocator
 */
interface IssResponseInteface
{
    /**
     * @return array
     */
    public function get(): array;
}