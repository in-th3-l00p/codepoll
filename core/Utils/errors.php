<?php

function abort(int $code) {
    view("errors.{$code}");
    http_response_code($code);
    die();
}

function notFound() {
    abort(404);
}

function unauthorized() {
    abort(401);
}
