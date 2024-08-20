<?php

namespace core\Utils;

function abort(int $code) {
    view("errors.{$code}");
    die($code);
}

function notFound() {
    abort(404);
}

function unauthorized() {
    abort(401);
}
