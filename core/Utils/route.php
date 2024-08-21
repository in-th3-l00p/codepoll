<?php

use core\App;
use JetBrains\PhpStorm\NoReturn;

function route(string $route_name): string
{
    return App::getInstance()
        ->getRouter()
        ->getRoute($route_name)
        ->getPath();
}

#[NoReturn] function back(): void
{
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit();
}

#[NoReturn] function redirect(string $path): void
{
    header("Location: " . $path);
    exit();
}