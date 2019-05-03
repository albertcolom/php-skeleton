<?php

declare(strict_types=1);

namespace App\Application;

use App\Domain\Repository\FooRepository;

class FooClass
{
    /** @var FooRepository */
    private $fooRepository;

    public function __construct(FooRepository $fooRepository)
    {
        $this->fooRepository = $fooRepository;
    }

    public function __invoke()
    {
        echo '<h1>Home php-skeleton</h1>';
    }

    public function hello(string $name = 'world')
    {
        $fooModel = $this->fooRepository->get($name);
        echo '<h1>☞ Hello ' . $fooModel->name() . '   :-)</h1>';
    }

    public function info()
    {
        echo phpinfo();
    }
}
