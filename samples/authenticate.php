<?php

require_once __DIR__ . '/config/bootstrap.php';

use CHRobinson\CHRobinsonAPI;
use CHRobinson\Environment\SandboxEnvironment;

$api = new CHRobinsonAPI(new SandboxEnvironment(
    getenv('SANDBOX_CLIENT_ID'),
    getenv('SANDBOX_CLIENT_SECRET')
));


