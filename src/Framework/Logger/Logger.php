<?php

namespace Framework\Logger;

use Monolog\Handler\StreamHandler;

require $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';

/**
 * Class Logger
 * @package Framework\Logger
 */
class Logger
{
    protected static $instance;

    /**
     * @return mixed
     */
    public static function getLogger()
    {
        if (!self::$instance) {
            self::configureInstance();
        }
        return self::$instance;
    }

    private static function configureInstance(): void
    {
        date_default_timezone_set('Europe/Minsk');

        $logger = new \Monolog\Logger("PageLoad");
        $logger->pushHandler( new StreamHandler(
            $_SERVER['DOCUMENT_ROOT']."/logs/info.log",
            \Monolog\Logger::INFO
        ));
        self::$instance = $logger;
    }

    /**
     * @param $pageURL
     */
    public function logLoadedPage($pageURL): void
    {
        self::getLogger()->info("Successful load", array("Page" => $_SERVER["HTTP_HOST"].$pageURL));
    }
}