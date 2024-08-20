<?php

namespace core;

use core\Http\Router;

// application starting point
// singleton
class App
{
    // singleton instance
    private static self $instance;

    /**
     * Initialize the app
     */
    public static function initialize(): void
    {
        self::$instance = new self();
    }

    /**
     * @return self : app instance
     * @throws \Exception : if app not initialized
     */
    public static function getInstance(): self
    {
        if (!self::$instance) {
            throw new \Exception("App not initialized");
        }
        return self::$instance;
    }

    private Router $router;

    /**
     * Initialize the app
     */
    public function __construct()
    {
        Container::initialize();
        $this->router = new Router();
    }

    /**
     * Get the router
     * @return Router : app's router object
     */
    public function getRouter(): Router
    {
        return $this->router;
    }


    // run everything
    // basically a bridge between core functionality and app functionality
    public function run()
    {
        require BASE_PATH . "/app/routes.php";
        $this->router->handle();
    }
}