<?php
declare(strict_types=1);


namespace App\Services\IssLocator;


use App\Services\IssLocator\Exceptions\DefinedLocatorPath;
use App\Services\IssLocator\Exceptions\NotDefinedLocatorPath;
use App\Services\IssLocator\Response\IssErrorResponse;
use App\Services\IssLocator\Response\IssResponse;
use App\Services\Response\ServiceResponseInteface;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;

/**
 * Class IssLocator
 * @package App\Services\IssLocator
 */
class IssLocator implements IssLocatorInterface
{

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var string
     */
    private $path;

    /**
     * IssLocator constructor.
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }


    /**
     * @param int $satelliteId
     * @return ServiceResponseInteface
     */
    public function locate(int $satelliteId): ServiceResponseInteface
    {
        try {
            return new IssResponse(
                $this->client->request('GET', $this->path . '/' . $satelliteId)
            );
        } catch (NotDefinedLocatorPath | RequestException $exception) {
            return new IssErrorResponse($exception->getMessage(), $exception->getCode());
        }
    }

    /**
     * @param string $path
     * @throws DefinedLocatorPath
     */
    public function setPath(string $path): void
    {
        if (null !== $this->path) {
            throw new DefinedLocatorPath('Locator path has been set. You can not override this value');
        }

        $this->path = $path;
    }

    /**
     * @return string
     * @throws NotDefinedLocatorPath
     */
    public function getPath(): string
    {
        if (null === $this->path) {
            throw new NotDefinedLocatorPath('You have to set path variable first');
        }

        return $this->path;
    }


}