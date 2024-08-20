<?php

namespace core\Utils;

function view($view, $data = []) {
    extract($data);
    $view = str_replace(".", "/", $view);
    include BASE_PATH . "views/$view.view.php";
    die();
}
