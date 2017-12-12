<?php
declare(strict_types=1);

namespace App\Services\IssLocator\Response;


use App\Services\Response\ServiceResponseInteface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class IssResponse
 * @package App\Services\IssLocator
 */
class IssResponse implements ServiceResponseInteface
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
            'id'        => $id,
            'name'      => $name,
            'latitude'  => $latitude,
            'longitude' => $longitude,
        ] = json_decode($this->response->getBody()->getContents(), true);

        return [
            'name'      => strtoupper($name),
            'id'        => $id,
            'latitude'  => $latitude,
            'longitude' => $longitude,
        ];
    }

}