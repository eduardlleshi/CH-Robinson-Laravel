<?php

use TruckHub\Classes\CHRobinsonAPI;

require_once __DIR__ . '/vendor/autoload.php';

define('CH_ROBINSON_CLIENT_ID', '0oa26nez8iBWOHb9A357');
define('CH_ROBINSON_CLIENT_SECRET', 'GlhuTizOwV_JFUTt0L6NNzI-QT2hx6Z-CLopqru0');

$api = new CHRobinsonAPI;

dump($api);