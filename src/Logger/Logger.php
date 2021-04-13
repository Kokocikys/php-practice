<?php

namespace App\Logger;

require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

/**
 * Class Logger
 * @package App\Logger
 */
class Logger
{
    /**
     * @var
     */
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

    /**
     *
     */
    private static function configureInstance(): void
    {
        date_default_timezone_set('Europe/Minsk');

        $logger = new \Monolog\Logger("PageLoad");
        $logger->pushHandler( new \Monolog\Handler\StreamHandler(
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
        self::getLogger()->addInfo("Successful load", array("Page" => $pageURL));
    }
}