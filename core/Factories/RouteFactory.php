<?php

namespace core\Factories;

use core\App;
use core\Http\Method;
use core\Http\Route;

class RouteFactory {
    /**
     * Add a GET route
     * @param string $name : route name
     * @param string $path : route path
     * @param string $controller : controller class
     * @return void : no return
     * @throws \Exception : if app not initialized
     */
    public static function get(string $name, string $path, string $controller) {
        $route = new Route($name, $path, Method::GET, $controller);
        App::getInstance()->getRouter()->add($route);
    }

    /**
     * Add a POST route
     * @param string $name : route name
     * @param string $path : route path
     * @param string $controller : controller class
     * @return void : no return
     * @throws \Exception : if app not initialized
     */
    public static function post(string $name, string $path, string $controller) {
        $route = new Route($name, $path, Method::POST, $controller);
        App::getInstance()->getRouter()->add($route);
    }

    /**
     * Add a PUT route
     * @param string $name : route name
     * @param string $path : route path
     * @param string $controller : controller class
     * @return void : no return
     * @throws \Exception : if app not initialized
     */
    public static function put(string $name, string $path, string $controller) {
        $route = new Route($name, $path, Method::PUT, $controller);
        App::getInstance()->getRouter()->add($route);
    }

    /**
     * Add a DELETE route
     * @param string $name : route name
     * @param string $path : route path
     * @param string $controller : controller class
     * @return void : no return
     * @throws \Exception : if app not initialized
     */
    public static function delete(string $name, string $path, string $controller) {
        $route = new Route($name, $path, Method::DELETE, $controller);
        App::getInstance()->getRouter()->add($route);
    }
}