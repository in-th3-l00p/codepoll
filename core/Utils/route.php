<?php

use core\App;

function route(string $route_name) {
    return App::getInstance()
        ->getRouter()
        ->getRoute($route_name)
        ->getPath();
}
