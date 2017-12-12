<?php
declare(strict_types=1);

namespace App\Services\Transformers;

/**
 * Class AbstractTransformer
 * @package App\Services\Transformers
 */
abstract class AbstractTransformer
{
    /**
     * @var array
     */
    protected $data;

    /**
     * @param array $data
     * @return AbstractTransformer
     */
    public function setData(array $data): AbstractTransformer
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return bool
     */
    public function dataExists(): bool
    {
        return isset($this->data)?? false;
    }

    /**
     * @return array
     */
    public abstract function transform(): array;
}