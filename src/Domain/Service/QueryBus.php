<?php

namespace App\Domain\Service;

interface QueryBus
{
    public function handle($command);
}
