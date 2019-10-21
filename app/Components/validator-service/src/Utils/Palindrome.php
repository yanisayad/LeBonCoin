<?php

namespace App\Utils;

class Palindrome
{
    /** @var string  */
    protected $name;

    /**
     * Palindrom constructor.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * Fonction permettant de définir si le nom est valide
     *
     * @return Boolean
     */
    public function isValid()
    {
        if (strtolower($this->name) === strtolower(strrev($this->name)))
            return false;
        return true;
    }
}
