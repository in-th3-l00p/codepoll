<?php

namespace app;

use core\Factories\RouteFactory;

RouteFactory::get("index", "/", "index");
RouteFactory::get("login.form", "/login", "auth.login");
