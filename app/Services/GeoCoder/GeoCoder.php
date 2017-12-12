<?php
declare(strict_types=1);

namespace App\Services\GeoCoder;

use App\Services\GeoCoder\Response\GeoResponse;
use App\Services\Response\ServiceResponseInteface;
use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class GeoCoder
 * @package App\Services\GeoCoder
 */
class GeoCoder implements GeoCoderInterface
{
    /**
     * @var string
     */
    private $path;
    /**
     * @var string
     */
    private $apiKey;
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * GeoCoder constructor.
     * @param ClientInterface $client
     * @param string $path
     * @param string $apiKey
     */
    public function __construct(ClientInterface $client, string $path, string $apiKey)
    {
        $this->client = $client;
        $this->path = $path;
        $this->apiKey = $apiKey;
    }


    /**
     * @param string $lat
     * @param string $long
     * @return ServiceResponseInteface
     */
    public function getGeoCode(string $lat, string $long): ServiceResponseInteface
    {
        return new GeoResponse($this->buildRequest($lat, $long));
    }


    /**
     * @param string $lat
     * @param string $long
     * @return ResponseInterface
     */
    private function buildRequest(string $lat, string $long): ResponseInterface
    {
        return $this->client->request('GET', $this->path,
            [
                'query' => [
                    'latlng' => $lat . ',' . $long,
                    'key' => $this->apiKey
                ],
            ]);
    }
}