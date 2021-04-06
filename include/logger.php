<?php

date_default_timezone_set('Europe/Minsk');

$log = new Monolog\Logger("PageLoad");

$log->pushHandler(new Monolog\Handler\StreamHandler(
    "logs/info.log",
    Monolog\Logger::INFO
));

$log->addInfo("Successful load", array("Page" => __FILE__));