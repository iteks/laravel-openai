<?php

declare(strict_types=1);

namespace Iteks\Http\Exceptions;

use Exception;
use Throwable;

class RequestException extends Exception
{
    public function __construct(string $message = 'An error was encountered with the API.', int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
