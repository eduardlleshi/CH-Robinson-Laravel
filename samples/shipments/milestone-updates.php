<?php

require_once __DIR__ . '/../config/bootstrap.php';

use CHRobinson\Shipments\MilestoneUpdates;
use CHRobinson\Core\CHRobinsonHttpClient;
use CHRobinson\Core\SandboxEnvironment;

$request = new MilestoneUpdates;
$request->body = [
    'carrierCode' => 'T142351'
];

$client = new CHRobinsonHttpClient(new SandboxEnvironment(
    getenv('SANDBOX_CLIENT_ID'),
    getenv('SANDBOX_CLIENT_SECRET')
));

$response = $client->execute($request);

dump($response);