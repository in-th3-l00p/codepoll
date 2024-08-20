<?php
    const BASE_PATH = __DIR__ . "/";
    require_once "core/Helper/components.php";

    if ($argc === 1) {
        echo " Specify an argument\n";
        componentsHelp();
        die();
    }

    // parsing parameters
    $parameters = $argv;
    $parameters = array_splice($parameters, 3);
    foreach ($parameters as $arg) {
        if (str_starts_with($arg, "--")) {
            if (str_contains("=", $arg)) {
                $arg = explode("=", $arg);
                $_GET[substr($arg[0], 2)] = $arg[1];
            } else {
                $_GET[substr($arg, 2)] = true;
            }
        }
    }

    // executing command
    switch ($argv[1]) {
        case "make:component":
            if (!isset($argv[2])) {
                echo "Specify a component name\n";
                echo "Usage: php helper make:component [name]\n";
                break;
            }
            createComponent($argv[2]);
            break;
        default:
            echo "Invalid argument\n";
    }