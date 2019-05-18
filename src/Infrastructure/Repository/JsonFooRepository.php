<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Model\FooModel;
use App\Domain\Repository\FooRepository;

class JsonFooRepository implements FooRepository
{
    private const FOO_PATH_JSON_REPOSITORY = __DIR__ . '/../../../var/cache/Foo.json';

    public function __construct()
    {
        $this->ensureFileExist(self::FOO_PATH_JSON_REPOSITORY);
    }

    public function persist(FooModel $foo): void
    {
        $file_content = file_get_contents(self::FOO_PATH_JSON_REPOSITORY);

        if ('' === $file_content) {
            file_put_contents(self::FOO_PATH_JSON_REPOSITORY, json_encode([$foo->name()]));
            return;
        }

        $foo_content = array_merge(json_decode($file_content, true), [$foo->name()]);
        file_put_contents(self::FOO_PATH_JSON_REPOSITORY, json_encode($foo_content));
    }

    public function getAll(): array
    {
        $file_content = file_get_contents(self::FOO_PATH_JSON_REPOSITORY);

        if ('' === $file_content) {
            return [];
        }

        return json_decode($file_content, true);
    }

    private function ensureFileExist(string $path): void
    {
        if (!file_exists($path)) {
            touch($path);
        }
    }
}