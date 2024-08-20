<?php

function view($view, $data = []) {
    extract($data);
    $view = str_replace(".", "/", $view);
    include BASE_PATH . "views/$view.view.php";
}

// todo implement class logics
function component($component, $data = []): void {
    view("components." . $component, $data);
}
