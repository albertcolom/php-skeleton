<?php

namespace App\Domain\Repository;

use App\Domain\Model\FooModel;

interface FooRepository
{
    public function persist(FooModel $foo): void;
    public function getAll(): array;
}