<?php

require 'vendor/autoload.php';
require 'include/logger.php';

$greetings = new App\Frase\Greetings();
$greetings->sayHello();

echo "<br>";

$showDate = new App\Action\Date();
$showDate->showDate();