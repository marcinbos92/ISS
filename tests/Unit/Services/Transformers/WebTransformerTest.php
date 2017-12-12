<?php
declare(strict_types=1);

namespace Tests\Unit\Services\Transformers;

use App\Services\Transformers\AbstractTransformer;
use App\Services\Transformers\Exceptions\DataNotSetException;
use App\Services\Transformers\WebTransformer;
use Tests\TestCase;

/**
 * Class WebTransformerTest
 * @package Tests\Unit\Services\Transformers
 */
class WebTransformerTest extends TestCase
{

    /**
     * @var AbstractTransformer
     */
    private $webTransformer;


    protected function setUp()
    {
        $this->webTransformer = new WebTransformer();
    }


    public function testWebTransformerObjectWhileIssIsOnLand(): void
    {
        $this->webTransformer->setData([
            'coordinates' => [
                'latitude'  => '50.0000',
                'longitude' => '50.0000',
            ],
            'address' => [
                'formatted_address' => 'Street X',
            ],
        ]);

        $data = $this->webTransformer->transform();

        $this->assertArrayHasKey('latitude', $data);
        $this->assertArrayHasKey('longitude', $data);
        $this->assertArrayHasKey('position_message', $data);

        $this->assertSame('50.0000', $data['latitude']);
        $this->assertSame('50.0000', $data['longitude']);
        $this->assertSame('Street X', $data['position_message']);

    }

    public function testWebTransformerObjectWhileIssIsOnOceanOrSea(): void
    {
        $this->webTransformer->setData([
            'coordinates' => [
                'latitude'  => '22.33',
                'longitude' => '22.22',
            ],
            'address' => [
                'message' => 'Hello',
            ],
        ]);

        $data = $this->webTransformer->transform();

        $this->assertArrayHasKey('latitude', $data);
        $this->assertArrayHasKey('longitude', $data);
        $this->assertArrayHasKey('position_message', $data);

        $this->assertSame('22.33', $data['latitude']);
        $this->assertSame('22.22', $data['longitude']);
        $this->assertSame('Hello', $data['position_message']);

    }

    public function testUnsetData(): void
    {
        $this->expectException(DataNotSetException::class);

        $this->webTransformer->transform();
    }

    public function testIncorrectData(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->webTransformer->setData([
            'coordinate' => [
                'latitude'  => '22.33',
                'longitude' => '22.22',
            ],
            'address' => [
                'messages' => 'Hello',
            ],
        ]);

        $this->webTransformer->transform();
    }

    public function testIfDataWasSet(): void
    {
        $this->assertSame(false, $this->webTransformer->dataExists());
    }
}