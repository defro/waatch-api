<?php

namespace Defro\Waatch;

use RuntimeException;
use Throwable;

class Exception extends RuntimeException
{
    public function __construct(string $message, Throwable $previous = null)
    {
        parent::__construct($message, 0, $previous);
    }
}
