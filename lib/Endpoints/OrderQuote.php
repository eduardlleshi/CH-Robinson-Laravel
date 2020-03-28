<?php

namespace CHRobinson\Endpoints;

use CHRobinson\Http\HttpRequest;

class OrderQuote extends HttpRequest
{
    public function __construct()
    {
        parent::__construct('/v1/orders/quotes', 'POST');
        $this->headers['Content-Type'] = 'application/json';
    }
}
