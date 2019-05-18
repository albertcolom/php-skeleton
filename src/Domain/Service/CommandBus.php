<?php

namespace App\Domain\Service;

interface CommandBus
{
    public function handle($command);
}
