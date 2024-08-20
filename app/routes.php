<?php

namespace app;

use core\Factories\RouteFactory;

RouteFactory::get("index", "/", "index");
RouteFactory::get("test", "/test", "test");
