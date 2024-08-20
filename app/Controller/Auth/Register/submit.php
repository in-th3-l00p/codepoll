<?php

use core\Utils\Validator;

Validator::validateRequest([
    "username" => "username",
    "email" => "email",
    "first_name" => "name",
    "last_name" => "name",
    "password" => "password",
    "password_confirmed" => "password"
]);