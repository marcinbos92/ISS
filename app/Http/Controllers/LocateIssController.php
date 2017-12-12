<?php

namespace App\Http\Controllers;

use App\Services\GeoCoder\GeoCoderInterface;
use App\Services\IssLocator\IssLocatorInterface;
use App\Services\Transformers\AbstractTransformer;
use Symfony\Component\HttpFoundation\Response;

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
     * @var GeoCoderInterface
     */
    private $geoCoder;
    /**
     * @var AbstractTransformer
     */
    private $transformer;

    /**
     * LocateIssController constructor.
     * @param IssLocatorInterface $issLocator
     * @param GeoCoderInterface $geoCoder
     * @param AbstractTransformer $transformer
     */
    public function __construct(IssLocatorInterface $issLocator, GeoCoderInterface $geoCoder, AbstractTransformer $transformer)
    {
        $this->issLocator = $issLocator;
        $this->geoCoder = $geoCoder;
        $this->transformer = $transformer;
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
        $data = $this->issLocator->locate($sateliteId)->get();

        return view('iss', $this->transformer->setData([
            'coordinates'   => $data,
            'address'      => $this->geoCoder->getGeoCode($data['latitude'], $data['longitude'])->get(),
        ])->transform());
    }
}
