<?php
declare(strict_types=1);

namespace App\Services\Transformers;

use App\Services\Transformers\Exceptions\DataNotSetException;

/**
 * Class WebTransformer
 * @package App\Services\Transformers
 */
class WebTransformer extends AbstractTransformer
{
    /**
     * @return array
     * @throws DataNotSetException
     */
    public function transform(): array
    {
        if (!$this->dataExists()) {
            throw new DataNotSetException('You have to set data first');
        }

        return $this->getArray();
    }

    /**
     * @return array
     */
    private function getArray(): array
    {
        $this->checkData();

        [
            'coordinates' => $coordinates,
            'address'     => $address,
        ] = $this->data;

        return [
            'latitude'          => $coordinates['latitude'],
            'longitude'         => $coordinates['longitude'],
            'position_message'  => array_key_exists('formatted_address', $address)? $address['formatted_address'] : $address['message'],
        ];
    }

    /**
     * @throws \InvalidArgumentException
     */
    private function checkData(): void
    {
        if (!array_key_exists('coordinates', $this->data)) {
            throw new \InvalidArgumentException('Data array should contain coordinates key');
        }

        if (!array_key_exists('address', $this->data)) {
            throw new \InvalidArgumentException('Data array should contain address key');
        }

        if (!array_key_exists('latitude', $this->data['coordinates'])) {
            throw new \InvalidArgumentException('Data array should contain coordinates.latitude key');
        }

        if (!array_key_exists('longitude', $this->data['coordinates'])) {
            throw new \InvalidArgumentException('Data array should contain coordinates.longitude key');
        }
    }
}