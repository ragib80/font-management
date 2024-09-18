<?php

namespace App\Controllers;


class DashboardController
{
    public function index(): void
    {
        include(__DIR__ . '/../views/layouts/layout.php');
    }
}
