<?php

require $_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php';
require 'include/logger.php';

$greetings = new App\Frase\Greetings();
$showDate = new App\Action\Date();
$mailer = new Koko\Mailer\Standard();
$httpClient = new Koko\Http\Client();
$test = new App\Shit\ShityLogic($mailer, $httpClient);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP practice</title>
</head>
<body>
<div>
    <div>
        <?= $greetings->sayHello() ?>
    </div>
    <div>
        Current date: <?= $showDate->showDate() ?>
    </div>
</div>

<div style="font-size: 32px;">
    <?= $test->lastChar("010") ?>
</div>

<div>
    <a href="/anotherPage/index.php">Go to another page!</a>
</div>

</body>
</html>