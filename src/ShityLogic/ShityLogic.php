<?php

namespace App\Shit;

use Koko\Http\Client;
use Koko\Mailer\Mailer;

require 'vendor/autoload.php';

/**
 * @property \Koko\Mailer\Mailer mailer
 * @property \Koko\Http\Client httpClient
 */
class ShityLogic
{
    protected Mailer $mailer;
    protected Client $httpClient;
    protected string $var;

    public function __construct(Mailer $mailer, Client $httpClient)
    {
        $this->mailer = $mailer;
        $this->httpClient = $httpClient;
    }

    /**
     * @return string
     */
    public function getRes(): string
    {
        return $this->var;
    }

    /**
     * @param string $str
     */
    public function setRes(string $str): void
    {
        $this->var = $str;
    }

    public function lastChar($str): string
    {
        $someData = $this->httpClient->getData();

        if (substr($str, -1) === "1" && $someData != '') {
            $result = '$str last char is 1';
        } else {
            $result = '$str last char is 0';
        }

        $this->mailer->send();

        return $result;
    }
}