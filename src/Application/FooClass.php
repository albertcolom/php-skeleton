<?php

declare(strict_types=1);

namespace App\Application;

use App\Domain\Service\CommandBus;

class FooClass
{
    /** @var GetAllFoo  */
    private $getAllFoo;
    /** @var CommandBus  */
    private $commandBus;

    public function __construct(GetAllFoo $getAllFoo, CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
        $this->getAllFoo = $getAllFoo;
    }

    public function __invoke()
    {
        echo '<h1>Home php-skeleton</h1>';
    }

    public function hello(string $name = 'world')
    {
        $this->commandBus->handle(new CreateFooCommand($name));
        echo '<h1>☞ Hello ' . $name . '   :-)</h1>';

        $foo_content = $this->getAllFoo->__invoke();
        var_dump(json_encode($foo_content));
    }

    public function info()
    {
        echo phpinfo();
    }
}
