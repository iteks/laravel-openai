<?php

declare(strict_types=1);

namespace Iteks\Http\Exceptions;

use Exception;
use Throwable;

class AuthenticationException extends Exception
{
    public function __construct(string $message = 'Unauthorized: Invalid or missing API key.', int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
