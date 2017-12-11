<?php
declare(strict_types=1);


namespace App\Services\IssLocator;


use App\Services\IssLocator\Exceptions\DefinedLocatorPath;
use App\Services\IssLocator\Exceptions\NotDefinedLocatorPath;
use GuzzleHttp\ClientInterface;

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
     * @return IssResponseInteface
     */
    public function locate(int $satelliteId): IssResponseInteface
    {
        try {
            return new IssResponse(
                $this->client->request('GET', $this->path . '/' . $satelliteId)
            );
        } catch (NotDefinedLocatorPath $exception) {
            printf("Message: %s", $exception->getMessage());
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
            throw new NotDefinedLocatorPath('Firts you have to set path variable');
        }

        return $this->path;
    }


}