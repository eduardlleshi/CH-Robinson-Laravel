<?php

require_once __DIR__ . '/../config/bootstrap.php';

use CHRobinson\Shipments\AvailableShipmentSearch;
use CHRobinson\Core\CHRobinsonHttpClient;
use CHRobinson\Core\SandboxEnvironment;

$request = new AvailableShipmentSearch;

$client = new CHRobinsonHttpClient(new SandboxEnvironment(
    getenv('SANDBOX_CLIENT_ID'),
    getenv('SANDBOX_CLIENT_SECRET')
));

$response = $client->execute($request);

dump($response);