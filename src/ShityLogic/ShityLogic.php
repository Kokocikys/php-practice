<?php

namespace App\Shit;

require 'vendor/autoload.php';

class ShityLogic
{
    protected string $res;

    /**
     * @return string
     */
    public function getRes(): string
    {
        return $this->res;
    }

    /**
     * @param string $res
     */
    public function setRes(string $res): void
    {
        $this->res = $res;
    }

    public function lastChar(): string
    {
        $var = $this->res;

        if (substr($var, -1) === "1") {
            $var = '$var last char is 1';
        } else {
            $var = '$var last char is 0';
        }

        $this->res = $var;
        return $this->res;
    }
}