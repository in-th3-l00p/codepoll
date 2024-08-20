<?php

namespace app;

use core\Factories\RouteFactory;

RouteFactory::get("index", "/", "index");

RouteFactory::get("login.form", "/login", "auth.login.form");

RouteFactory::get("register.form", "/register", "auth.register.form");
RouteFactory::post("register.submit", "/register", "auth.register.submit");
