<?php

declare(strict_types=1);

namespace App\Api;

use App\Application\Command\CreateFooCommand;
use App\Application\Query\GetAllFooQuery;
use App\Domain\Service\CommandBus;
use App\Domain\Service\QueryBus;

class FooController
{
    /** @var CommandBus */
    private $commandBus;
    /** @var QueryBus  */
    private $queryBus;

    public function __construct(CommandBus $commandBus, QueryBus $queryBus)
    {
        $this->commandBus = $commandBus;
        $this->queryBus = $queryBus;
    }

    public function post(): void
    {
        if (!isset($_REQUEST['foo'])) {
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(['status' => 400, 'data' => 'Bad Request']);
            return;
        }

        $this->commandBus->handle(new CreateFooCommand($_REQUEST['foo']));
        header('Content-Type: application/json');
        http_response_code(201);
    }

    public function getAll(): void
    {
        $foo_content = $this->queryBus->handle(new GetAllFooQuery());

        header('Content-Type: application/json');
        echo json_encode(['status' => 200, 'data' => $foo_content]);
    }
}
