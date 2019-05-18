<?php

declare(strict_types=1);

namespace App\Application;

use App\Domain\Model\FooModel;

class CreateFooCommand
{
    private $foo;

    public function __construct(string $foo)
    {
        $this->foo = $foo;
    }

    public function foo(): FooModel
    {
        return FooModel::create($this->foo);
    }
}
