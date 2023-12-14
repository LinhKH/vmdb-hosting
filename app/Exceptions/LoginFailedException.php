<?php

namespace App\Exceptions;

use Exception;
use InvalidArgumentException;


class LoginFailedException extends Exception
{
    private $messages;

    /**
     * @param string[]|string $messages
     */
    public function __construct($messages)
    {
        if (!is_array($messages) && !is_string($messages)) {
            throw new InvalidArgumentException('配列または文字列を引数としてください');
        }
        if (is_string($messages)) {
            $messages = [$messages];
        }
        $this->messages = $messages;
        parent::__construct(implode("\n", $messages));
    }

    public function getMessages()
    {
        return $this->messages;
    }
}
