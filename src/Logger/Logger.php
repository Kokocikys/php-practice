<?php

namespace App\Logger;

require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

class Logger
{
    protected static $instance;

    public static function getLogger()
    {
        if (!self::$instance) {
            self::configureInstance();
        }
        return self::$instance;
    }

    private static function configureInstance()
    {
        date_default_timezone_set('Europe/Minsk');

        $logger = new \Monolog\Logger("PageLoad");
        $logger->pushHandler( new \Monolog\Handler\StreamHandler(
            $_SERVER['DOCUMENT_ROOT']."/logs/info.log",
            \Monolog\Logger::INFO
        ));
        self::$instance = $logger;
    }

    public function logLoadedPage($pageURL): void
    {
        self::getLogger()->addInfo("Successful load", array("Page" => $pageURL));
    }
}