<?php
declare(strict_types=1);

namespace App\Services\IssLocator;

use Psr\Http\Message\ResponseInterface;

/**
 * Class IssResponse
 * @package App\Services\IssLocator
 */
class IssResponse implements IssResponseInteface
{

    /**
     * @var ResponseInterface
     */
    private $response;


    /**
     * IssResponse constructor.
     * @param ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }


    /**
     * @return array
     */
    public function get(): array
    {
        [
            'latitude' => $latitude,
            'longitude' => $longitude,
        ] = json_decode($this->response->getBody()->getContents(), true);

        return [
            'latitude' => $latitude,
            'longitude' => $longitude,
        ];
    }

}