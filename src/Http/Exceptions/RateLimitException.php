<?php

declare(strict_types=1);

namespace Iteks\Http\Exceptions;

use Exception;
use Throwable;

class RateLimitException extends Exception
{
    public function __construct(string $message = 'Rate limit exceeded: Too many requests.', int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
