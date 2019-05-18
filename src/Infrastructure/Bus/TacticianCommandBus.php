<?php

declare(strict_types=1);

namespace App\Infrastructure\Bus;

use App\Domain\Service\CommandBus;

class TacticianCommandBus implements CommandBus
{
    /** @var \League\Tactician\CommandBus */
    private $commandBus;

    public function __construct(array $middleware)
    {
        $this->commandBus = new \League\Tactician\CommandBus($middleware);
    }

    public function handle($command)
    {
        $this->commandBus->handle($command);
    }
}
