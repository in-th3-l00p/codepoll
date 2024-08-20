<?php

namespace core\Utils;

function view($view, $data = []) {
    extract($data);
    $view = str_replace(".", "/", $view);
    include BASE_PATH . "views/$view.view.php";
}

function getComponentClass(string $component) {
    $component = explode(".", $component);
    foreach ($component as $part)
        $part = ucfirst($part);
    $component = implode(".", $component);
    return BASE_PATH . "app/Components/" . $component . ".php";
}

function getComponentView(string $component) {
    $component = explode(".", $component);
    foreach ($component as $part)
        $part = lcfirst($part);
    $component = implode(".", $component);
    return "components." . $component;
}

// todo implement class logics
function component($component, $data = []) {
    view(getComponentView($component), $data);
//    if (file_exists($path = getComponentClass($component) . ".php")) {
//        include $path;
//    } else {
//        view(getComponentView($component), $data);
//    }
}