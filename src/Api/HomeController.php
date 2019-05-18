<?php

declare(strict_types=1);

namespace App\Api;

class HomeController
{
    public function hello()
    {
        header('Content-Type: application/json');
        echo json_encode(['status' => 200, 'data' => 'hello world']);
    }
}
