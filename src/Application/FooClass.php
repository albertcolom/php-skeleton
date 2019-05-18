<?php

declare(strict_types=1);

namespace App\Application;

use App\Domain\Model\FooModel;
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
        $this->fooRepository->persist(FooModel::create($name));
        echo '<h1>☞ Hello ' . $name . '   :-)</h1>';

        $foo_content = $this->fooRepository->getAll();
        var_dump(json_encode($foo_content));
    }

    public function info()
    {
        echo phpinfo();
    }
}
