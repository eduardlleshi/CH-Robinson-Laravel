<?php

namespace CHRobinson\Endpoints;

use CHRobinson\Http\HttpRequest;

class Events extends HttpRequest
{
    public function __construct()
    {
        parent::__construct('/v2/events', 'GET');
        $this->headers['Content-Type'] = 'application/json';
    }
}
