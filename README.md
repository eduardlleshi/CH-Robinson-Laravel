# CH Robinson PHP SDK by TruckHub Team

![Image description](https://github.com/mytruckhub/CH-Robinson-PHP-SDK/blob/master/CHRobinson-Banner.jpg)

This repository contains the C.H Robinson SDK and samples for the Shipments API. It includes a simplified interface to only provide simple model objects and blueprints for HTTP calls. Refer to the [C.H Robinson Developer portal](https://www.google.com) for more information.

## Prerequisites

PHP 7 and above

## Usage

### Setting up credentials

Obtain your Sandbox Client ID and Client Secret from C.H Robinson.

```php

use CHRobinson\Core\CHRobinsonHttpClient;
use CHRobinson\Core\SandboxEnvironment;

$client = new CHRobinsonHttpClient(new SandboxEnvironment(
    getenv('SANDBOX_CLIENT_ID'),
    getenv('SANDBOX_CLIENT_SECRET')
));

```

## Examples

### Sending a Milestone update with the Shipments API

```php

use CHRobinson\Shipments\MilestoneUpdates;

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

$response = $client->execute($request);

if ($response->getStatusCode() == 201) {
    echo 'Success';
}

```