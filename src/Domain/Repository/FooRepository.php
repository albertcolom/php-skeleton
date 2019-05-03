<?php

namespace App\Domain\Repository;

use App\Domain\Model\FooModel;

interface FooRepository
{
    public function get(string $name): FooModel;
}