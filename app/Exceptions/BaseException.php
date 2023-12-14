<?php

namespace App\Exceptions;

use Exception;


class BaseException extends Exception
{
    /**
     * @param string[]|string $messages
     */
    public function __construct($messages)
    {
        parent::__construct($messages);
    }

    public function getMessages()
    {
        return $this->getMessage();
    }
}
