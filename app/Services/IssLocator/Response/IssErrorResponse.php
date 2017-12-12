<?php
declare(strict_types=1);

namespace App\Services\IssLocator\Response;

use App\Services\Response\ServiceResponseInteface;


/**
 * Class IssErrorResponse
 * @package App\Services\IssLocator
 */
class IssErrorResponse implements ServiceResponseInteface
{
    /**
     * @var string
     */
    private $message;
    /**
     * @var int
     */
    private $statusCode;

    /**
     * IssErrorResponse constructor.
     * @param string $message
     * @param int $statusCode
     */
    public function __construct(string $message, int $statusCode = 404)
    {
        $this->message = $message;
        $this->statusCode = $statusCode;
    }

    /**
     * @return array
     */
    public function get(): array
    {
        return [
          'status_code' => $this->statusCode,
          'message'     => $this->message,
        ];
    }

}