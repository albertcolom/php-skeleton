<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Model\FooModel;
use App\Domain\Repository\FooRepository;

class InMemoryFooRepository implements FooRepository
{
    public function get(string $name): FooModel
    {
        return FooModel::create($name);
    }
}