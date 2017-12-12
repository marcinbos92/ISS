<?php
declare(strict_types=1);


namespace App\Services\Response;


/**
 * Interface ServiceResponseInteface
 * @package App\Services\Response
 */
interface ServiceResponseInteface
{
    /**
     * @return array
     */
    public function get(): array;
}