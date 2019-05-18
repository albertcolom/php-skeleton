<?php

declare(strict_types=1);

namespace App\Application\Command;

use App\Domain\Repository\FooRepository;

class CreateFooHandler
{
    /** @var FooRepository */
    private $fooRepository;

    public function __construct(FooRepository $fooRepository)
    {
        $this->fooRepository = $fooRepository;
    }

    public function __invoke(CreateFooCommand $command): void
    {
        $this->fooRepository->persist($command->foo());
    }
}