<?php

use core\App;
use core\Http\Session;
use core\Utils\Validator;

$body = Validator::validateRequest([
    "username" => "username",
    "email" => "email",
    "first_name" => "name",
    "last_name" => "name",
    "password" => "password",
    "password_confirmed" => "password"
]);

if ($body->password !== $body->password_confirmed) {
    Session::setFlash("password_confirmed", "Passwords do not match.");
    back();
}

App::getInstance()
    ->getDatabase()
    ->getPDO()
    ->prepare("INSERT INTO users (username, email, first_name, last_name, password, created_at) VALUES (?, ?, ?, ?, ?, ?)")
    ->execute([
        $body->username,
        $body->email,
        $body->first_name,
        $body->last_name,
        password_hash($body->password, PASSWORD_DEFAULT),
        date("Y-m-d H:i:s")
    ]);

Session::setFlash("success", "Account created successfully.");
redirect("/login");