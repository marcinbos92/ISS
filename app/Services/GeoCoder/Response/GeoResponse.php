<?php
declare(strict_types=1);

namespace App\Services\GeoCoder\Response;

use App\Services\Response\ServiceResponseInteface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class GeoResponse
 * @package App\Services\GeoCoder
 */
class GeoResponse implements ServiceResponseInteface
{
    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * GeoResponse constructor.
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
            'results' => $results,
        ] = json_decode($this->response->getBody()->getContents(), true);

        if (empty($results)) {
            return [
              'message' => 'ISS is offshore',
            ];
        }

        return [
            'formatted_address' => strtoupper($results[0]['formatted_address']),
        ];
    }

}