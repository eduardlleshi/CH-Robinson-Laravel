<?php

namespace TruckHub\Classes;

class CHRobinsonAPI
{
    public function __construct()
    {
        $this->clientId = CH_ROBINSON_CLIENT_ID;
        $this->clientSecret = CH_ROBINSON_CLIENT_SECRET;
    }
}
