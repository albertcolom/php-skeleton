<?php

declare(strict_types=1);

namespace App\Application\Query;

use App\Domain\Repository\FooRepository;

class GetAllFooHandler
{
    /** @var FooRepository  */
    private $fooRepository;

    public function __construct(FooRepository $fooRepository)
    {
        $this->fooRepository = $fooRepository;
    }

    public function __invoke(): array
    {
        return $this->fooRepository->getAll();
    }
}
