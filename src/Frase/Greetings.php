<?php

namespace App\Frase;

require 'vendor/autoload.php';

class Greetings
{
    public function sayHello()
    {
        $generator = \Nubs\RandomNameGenerator\All::create();
        echo "Hello, ".$generator->getName()."!";
    }
}