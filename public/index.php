<?php
    // loading resource files if needed
    if (preg_match('/\.(?:png|jpg|jpeg|gif|css|js)$/', $_SERVER["REQUEST_URI"])) {
        return false;
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CodePoll</title>

    <link rel="stylesheet" href="/app.css">
</head>
<body class="min-h-screen h-full flex flex-col">
    <?php
        const BASE_PATH = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR;

        use core\App;
        require BASE_PATH . "core/Utils/utils.php";

        spl_autoload_register(function ($class) {
            require BASE_PATH . str_replace("\\", "/", $class) . ".php";
        });

        // running the app
        try {
            App::initialize();
            App::getInstance()->run();
        } catch (Exception $e) {
            echo "failed to start the app have no idea why";
        }
    ?>
</body>
</html>

