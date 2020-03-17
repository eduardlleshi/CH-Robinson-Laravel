<?php

namespace CHRobinson\Endpoints;

use CHRobinson\Http\HttpRequest;

class Rate extends HttpRequest
{
    public function __construct()
    {
        parent::__construct('/v1/quotes', 'POST');
        $this->headers['Content-Type'] = 'application/json';
    }
}
