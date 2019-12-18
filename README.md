# CH Robinson PHP SDK by TruckHub Team

![Image description](https://github.com/mytruckhub/CH-Robinson-PHP-SDK/blob/master/CHRobinson-Banner.jpg)

This repository contains the C.H Robinson SDK and samples for the Shipments API. It includes a simplified interface to only provide simple model objects and blueprints for HTTP calls. Refer to the [C.H Robinson Developer portal](https://www.google.com) for more information.

## Prerequisites

PHP 7 and above

## Usage

### Setting up credentials

Obtain your Sandbox Client ID and Client Secret from C.H Robinson.

```php
// Construct a request object and set desired parameters
// Here, OrdersCreateRequest() creates a POST request to /v2/checkout/orders
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
$request = new OrdersCreateRequest();
$request->prefer('return=representation');
$request->body = [
                     "intent" => "CAPTURE",
                     "purchase_units" => [[
                         "reference_id" => "test_ref_id1",
                         "amount" => [
                             "value" => "100.00",
                             "currency_code" => "USD"
                         ]
                     ]],
                     "application_context" => [
                          "cancel_url" => "https://example.com/cancel",
                          "return_url" => "https://example.com/return"
                     ] 
                 ];

try {
    // Call API with your client and get a response for your call
    $response = $client->execute($request);
    
    // If call returns body in response, you can get the deserialized version from the result attribute of the response
    print_r($response);
}catch (HttpException $ex) {
    echo $ex->statusCode;
    print_r($ex->getMessage());
}
```