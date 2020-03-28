<?php

namespace CHRobinson\Endpoints;

use CHRobinson\Http\HttpRequest;

class GenerateBol extends HttpRequest
{
    public function __construct()
    {
        parent::__construct('/v1/documents/generateBols', 'POST');
        $this->headers['Content-Type'] = 'application/json';
    }
}
