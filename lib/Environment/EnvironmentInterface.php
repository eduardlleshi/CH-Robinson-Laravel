<?php

namespace CHRobinson\Environment;

interface EnvironmentInterface
{
    public function getClientId(): string;
    public function getClientSecret(): string;
}
