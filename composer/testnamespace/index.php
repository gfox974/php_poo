<?php
require_once __DIR__ . '/vendor/autoload.php';

use monolog\Logger;
use monolog\Handler\StreamHandler;

$log = new Monolog\Logger('name');
$log->pushHandler(new StreamHandler('app.log', monolog\Logger::WARNING));
$log->warning('Foo');

?>