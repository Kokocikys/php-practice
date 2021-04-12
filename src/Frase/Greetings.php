<?php

namespace App\Frase;

require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

/**
 * Class Greetings
 * @package App\Frase
 */
class Greetings
{
    /**
     * @return string
     */
    public function sayHello(): string
    {
        $generator = \Nubs\RandomNameGenerator\All::create();
        return "Hello, " . $generator->getName() . "!";
    }
}