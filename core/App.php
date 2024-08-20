<?php

namespace core;

use core\Http\Router;
use core\Database\Database;

// application starting point
// singleton
// todo error handling
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

    // app's logics
    private Router $router;

    /**
     * Initialize the app
     * @throws \Exception : if container fails to initialize
     */
    public function __construct()
    {
        Container::initialize();
        Container::get()->bind("router", new Router());
        Container::get()->bind("database", new Database());
    }

    /**
     * Get the router
     * @return Router : app's router object
     * @throws \Exception : if container is not initialized
     */
    public function getRouter(): Router
    {
        return Container::get()->resolve("router");
    }

    /**
     * Get the database
     * @return Database : app's database object
     * @throws \Exception : if container is not initialized
     */
    public function getDatabase(): Database
    {
        return Container::get()->resolve("database");
    }


    // run everything
    // basically a bridge between core functionality and app functionality
    /**
     * runs the app
     * @throws \Exception : if the container fails to initialize
     */
    public function run()
    {
        require BASE_PATH . "/app/routes.php";
        $this->getRouter()->handle();
    }
}