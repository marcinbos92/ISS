<?php

namespace App\Http\Controllers;

use App\Services\IssLocator\IssLocatorInterface;
use Illuminate\Http\Response;

/**
 * Class LocateIssController
 * @package App\Http\Controllers
 */
class LocateIssController extends Controller
{
    private const DEFAULT_SATELLITE_ID = 25544;

    /**
     * @var IssLocatorInterface
     */
    private $issLocator;

    /**
     * LocateIssController constructor.
     * @param IssLocatorInterface $issLocator
     */
    public function __construct(IssLocatorInterface $issLocator)
    {
        $this->issLocator = $issLocator;
    }

    /**
     * @param int $sateliteId
     *
     * == DOC ==
     * Currently, there is only one, the International Space Station.
     * But in the future, we plan to provide more.
     *
     * @return Response
     */
    public function __invoke(int $sateliteId = self::DEFAULT_SATELLITE_ID)
    {
        return new Response($this->issLocator->locate($sateliteId)->get());
    }
}
