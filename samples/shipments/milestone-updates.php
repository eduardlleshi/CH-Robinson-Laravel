<?php

require_once __DIR__ . '/../config/bootstrap.php';

use CHRobinson\Shipments\MilestoneUpdates;
use CHRobinson\Core\CHRobinsonHttpClient;
use CHRobinson\Core\SandboxEnvironment;

$request = new MilestoneUpdates;
$request->body = [
    'eventCode' => 'X6',
    'shipmentIdentifier' => [
        'shipmentNumber' => '123456789'
    ],
    'dateTime' => [
        'eventDateTime' => '2019-12-16T18:36:13.131Z'
    ],
    'location' => [
        'address' => [
            'address1' => 'address if known, or blank',
            'city' => 'state if known, or blank',
            'stateProvinceCode' => 'state if known, or blank',
            'country' => 'US',
            'latitude' => '31.717096',
            'longitude' => '-99.132553'
        ]
    ]
];

$client = new CHRobinsonHttpClient(new SandboxEnvironment(
    getenv('SANDBOX_CLIENT_ID'),
    getenv('SANDBOX_CLIENT_SECRET')
));

$response = $client->execute($request);

if ($response->getStatusCode() == 201) {
    echo 'Success';
}
