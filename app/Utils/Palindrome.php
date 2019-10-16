<?php

namespace App\Utils;

class Palindrome {

    /** @var string  */
    protected $name;

    /**
     * Palindrom constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function isValid()
    {
        if ($this->name === strrev($this->name))
            return false;
        return true;
    }

}
