<?php

use core\Http\Session;

function view($view, $data = [])
{
    extract($data);
    $view = str_replace(".", "/", $view);
    include BASE_PATH . "views/$view.view.php";
}

// todo implement class logics
function component($component, $data = []): void
{
    view("components." . $component, $data);
}

/**
 * Display error message if it exists.
 * @param string $error_key The key of the error message.
 * @return void
 */
function formError(string $error_key): void
{
    if (Session::has("errors") && isset(Session::get("errors")[$error_key])) {
        component("error", [
            "message" => Session::get("errors")[$error_key]
        ]);
    }
}