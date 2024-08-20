<?php
    // loading resource files if needed
    if (preg_match('/\.(?:png|jpg|jpeg|gif|css|js)$/', $_SERVER["REQUEST_URI"])) {
        return false;
    }

    const BASE_PATH = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR;

    use core\App;
    require BASE_PATH . "core/Utils/utils.php";

    spl_autoload_register(function ($class) {
        require BASE_PATH . str_replace("\\", "/", $class) . ".php";
    });

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CodePoll</title>

    <link rel="stylesheet" href="/styles/app.css">
</head>
<body class="min-h-screen h-full flex flex-col">
    <?php
        // running the app
        try {
            App::initialize();

            dd(App::getInstance()->getDatabase()->getPDO()
                ->prepare("INSERT INTO users (username, email, first_name, last_name, description, pfp_path, password, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)")
                ->execute([
                    "ben",
                    "ben@example.com",
                    "Ben",
                    "Helped",
                    "I am a helper",
                    "pfp.jpg",
                    password_hash("password", PASSWORD_DEFAULT),
                    date("Y-m-d H:i:s")
                ]));
            App::getInstance()->run();
        } catch (Exception $e) {
            echo "ben helped error: " . $e->getMessage();
        }
    ?>
</body>
</html>

