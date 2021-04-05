<?php

namespace App\Action;

/**
 * Class Date
 * @package App\Action
 */
class Date
{
    /**
     * @return string
     */
    public function showDate(): string
    {
        return date("jS \of F, Y");
    }
}