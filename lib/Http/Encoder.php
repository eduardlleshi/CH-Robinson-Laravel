<?php

namespace CHRobinson\Http;

class Encoder
{
    private $serializers = [];

    public function __construct()
    {
        $this->serializers[] = new Json();
        $this->serializers[] = new Text();
        $this->serializers[] = new Multipart();
        $this->serializers[] = new Form();
    }
}
