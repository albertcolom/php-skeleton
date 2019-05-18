<?php

declare(strict_types=1);

namespace App\Infrastructure\Bus;

use App\Domain\Service\QueryBus;
use League\Tactician\CommandBus;

class TacticianQueryBus implements QueryBus
{
    /** @var CommandBus */
    private $commandBus;

    public function __construct(array $middleware)
    {
        $this->commandBus = new CommandBus($middleware);
    }

    public function handle($command)
    {
       return $this->commandBus->handle($command);
    }
}
