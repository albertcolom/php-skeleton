<?php

declare(strict_types=1);

namespace App\Api;

use App\Application\CreateFooCommand;
use App\Application\GetAllFoo;
use App\Domain\Service\CommandBus;

class FooController
{
    /** @var GetAllFoo */
    private $getAllFoo;
    /** @var CommandBus */
    private $commandBus;

    public function __construct(GetAllFoo $getAllFoo, CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
        $this->getAllFoo = $getAllFoo;
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
        $foo_content = $this->getAllFoo->__invoke();

        header('Content-Type: application/json');
        echo json_encode(['status' => 200, 'data' => $foo_content]);
    }
}
